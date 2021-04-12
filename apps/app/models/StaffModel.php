<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class StaffModel extends DatatableManagerModel {

	public function getSource() {
		return "staff";
	}

	public function columnMap() {
		return array(
			'id'                => 'id', 
			'type_id'     		=> 'type_id', 
			'fullname'          => 'fullname', 
			'title'             => 'title', 
			'manager'           => 'manager', 
			'department_id'     => 'department_id',
			'code'              => 'code', 
			'image'             => 'image', 
			'phone'             => 'phone', 
			'email'             => 'email', 
			'facebook'          => 'facebook', 
			'education'         => 'education', 
			'experience'        => 'experience', 
			'status'            => 'status', 
			'created'           => 'created', 
			'updated'           => 'updated', 
			'creator_id'        => 'creator_id', 
			'editor_id'         => 'editor_id',
			'position'  		=> 'position'
		);
	}
	private function getController() {
		return "staff";
	}
	public function initialize(){
		$this->belongsTo('department_id', '\Modules\App\Models\DepartmentModel', 'id', ['alias' => 'depart']);
	}
	
	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 's@fullname',
				'label' 	=> 'Họ và tên',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'depart',
				'label' 	=> 'Chức vụ',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 's@status',
				'label' 	=> 'Trạng thái',
				'width' 	=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name'		=> 'creator',
				'label' 	=> 'Người tạo',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 's@created',
				'label' 	=> 'Ngày tạo',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),			
			array (
				'name'  	=> 's@id',
				'label' 	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}

	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['s.fullname','d.title as depart','s.status','m.username as creator', 's.created', 's.id'],
			'from' 			=> ['s' => 'Modules\App\Models\StaffModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => ['alias' => 'm','on' => 's.creator_id=m.id'],
				'Modules\App\Models\DepartmentModel' => ['alias' => 'd','on' => 's.department_id=d.id']
			]
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);

			$result->json_data[] = array(
				's@fullname' 		=> $item->fullname,
				'depart'			=> $item->depart,
				's@status'  	    => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator' 			=> $item->creator,
				's@created' 		=> $item->created,
				's@id'				=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}