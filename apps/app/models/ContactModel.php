<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class ContactModel extends DatatableManagerModel {

	public function getSource() {
		return "contact";
	}

	public function columnMap() {
		return array(
			'id'      	=> 'id', 
			'fullname'	=> 'fullname', 
			'phone'   	=> 'phone',  
			'email'   	=> 'email',         
			'service'   => 'service',         
			'content' 	=> 'content', 
			'reply' 	=> 'reply', 
			'status'  	=> 'status', 
			'editor_id' => 'editor_id', 
			'created' 	=> 'created', 
			'updated' 	=> 'updated'
		);
	}
	
	private function getController() {
		return "contact";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 'fullname',
				'label' 	=> 'Họ và tên',
				'filter'	=> array(
					'type'	=> 'text'
				)
			),
			array (
				'name' 		=> 'email',
				'label' 	=> 'Địa chỉ email',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 'phone',
				'label' 	=> 'Số điện thoại',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 'status',
				'label' 	=> 'Xem thư',
				'width' 	=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Chưa xem',1=>'Đã xem')
				)
			),
			array (
				'name' 		=> 'created',
				'label' 	=> 'Ngày gửi',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'id',
				'label' 	=> 'Hành động',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}
	
	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' => ['fullname', 'phone', 'email', 'created', 'status', 'id']
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'view' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'fullname'  => $item->fullname,
				'phone'    	=> $item->phone,
				'email'     => $item->email,
				'status'    => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'created'   => $item->created,
				'id'     		=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}