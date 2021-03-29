<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class MemberModel extends DatatableManagerModel {   

  public function getSource() {
    return "member";
  }

	public function columnMap() {
		return array(
			'id' 						=> 'id', 
			'fullname'     	=> 'fullname', 
			'username'      => 'username', 
			'password'      => 'password', 
			'salt'          => 'salt', 
			'image'        	=> 'image',
			'email'         => 'email',
			'gender'        => 'gender', 
			'birthday'      => 'birthday',
			'address'       => 'address',
			'phone'         => 'phone', 
			'status'        => 'status', 
			'department_id' => 'department_id',
			'group_id'      => 'group_id',
			'visited'       => 'visited',  
			'creator_id'    => 'creator_id',
			'editor_id'   	=> 'editor_id',
			'created'       => 'created',
			'updated'      	=> 'updated',
		);
	}
	
	public function initialize(){
		$this->belongsTo('group_id', '\Modules\App\Models\PermissionGroupModel', 'id', array(
			'alias' 	=> 'permission_group',
			'reusable' => true
		));
	}
		
	private function getController() {
		return "member";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$tbl_permission_group   = new \Modules\App\Models\PermissionGroupModel();

		$init_data = array (
			array (
				'name'  	=> 'm@username',
				'label' 	=> 'Họ tên',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'm@email',
				'label' 	=> 'Địa chỉ email',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'group_name',
				'label' 	=> 'Nhóm',
				'filter'	=> array(
					'type' 	=> 'select',
					'value'	=> $tbl_permission_group ->list_item(),
				)
			),
			array (
				'name'		=> 'm@status',
				'label' 	=> 'Hiển thị',
				'width'		=> '80px',
				'filter'	=> array(
					'type'	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name'		=> 'creator',
				'label' 	=> 'Người tạo',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'm@created',
				'label' 	=> 'Ngày tạo',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
		
			array (
				'name'  	=> 'm@id',
				'label' 	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}

  public function datatable_json_data(){

		$member = new \Modules\Library\Oh\Member;

		$where = array();
		if($member->item->username == 'founder'){
			$where = ["m.username != 'founder'"];
		}else {
			$where = ["m.username != 'founder' AND m.username != 'admin'"];
		}
		
		$result = $this->datatable_find([
      'select' 		=> ['m.username', 'm.email','g.name as group_name','m.status','mm.username as creator','m.created','m.id'],
			'from' 			=> ['m' => 'Modules\App\Models\MemberModel'],
			'innerJoin' => [	
				'Modules\App\Models\MemberModel' 						=> ['alias' => 'mm', 'on' => 'm.creator_id=mm.id'],	
				'Modules\App\Models\PermissionGroupModel' 	=> ['alias' => 'g','on' => 'm.group_id=g.id']
			],
			'where'=> $where,
			'group_by' => array('m.id')
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'm@username' 			=> $item->username,
				'm@email' 				=> $item->email,
				'group_name' 			=> $item->group_name,
				'm@status'  			=> $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator' 				=> $item->creator,
				'm@created' 			=> $item->created,
				'm@id'						=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

	// public function validation() {   
		
	// 	$validator = new Validation();

	// 	$validator->add(
	// 		'email',
	// 		new UniquenessValidator([
	// 			'model' => $this,
	// 			'message' => 'Email này đã có người sử dụng!'
	// 		])
	// 	);

	// 	$validator->add(
	// 		'username',
	// 		new UniquenessValidator([
	// 			'model' => $this,
	// 			'message' => 'Tài khoản này đã có người sử dụng!'
	// 		])
	// 	);

	// 	return $this->validate($validator);
	// }
}