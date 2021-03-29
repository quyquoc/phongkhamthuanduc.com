<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class TestimonialModel extends DatatableManagerModel {

	public function getSource() {
		return "testimonial";
	}   

	public function columnMap() {
		return array(
			'id'          => 'id', 
			'name'        => 'name', 
			'info'        => 'info',
			'avatar'      => 'avatar', 
			'description' => 'description', 
			'status'   		=> 'status', 
			'creator_id'  => 'creator_id', 
			'editor_id'   => 'editor_id', 
			'created'     => 'created', 
			'updated'     => 'updated',
			'position'		=> 'position'
		);
	}

	/*public function beforeSave() {
		$this->updated = date('Y-m-d H:i:s');
		if(!($this->id > 0)){
			$this->created = date('Y-m-d H:i:s');
		}
	}*/ 

	private function getController() {
		return "testimonial";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}
	
	public function datatable_column(){
		$init_data = array (
			array (
				'name'		=> 't@name',
				'label' 	=> 'Khách hàng',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 't@info',
				'label' 	=> 'Thông tin',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 't@status',
				'label' 	=> 'Hiển thị',
				'width'		=> '80px',
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
				'name'		=> 't@created',
				'label' 	=> 'Ngày tạo',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 't@id',
				'label'		=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width'		=> '100px'
			)
		);
		return $init_data;
	}
	
	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['t.name','t.info','t.status','m.username as creator', 't.created', 't.id'],
			'from' 			=> ['t' => 'Modules\App\Models\TestimonialModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => ['alias' => 'm', 'on' => 't.creator_id=m.id', 'left']
			],
			'group_by' => array('t.id')
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				't@name' 	  	=> $item->name,
				't@info' 			=> $item->info,
				't@status'    => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator' 		=> $item->creator,
				't@created' 	=> $item->created,
				't@id'				=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

	public function list_item() {

		$list = array();
		$list_item =  $this->find(array('order'=>'name ASC'));
		foreach ($list_item as $value) {
			$list[$value->name]    = $value->name;
		}

		return $list;
	}
}
