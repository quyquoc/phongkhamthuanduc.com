<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class NewsletterModel extends DatatableManagerModel {  
	
	public function getSource() {
		return "newsletter";
	}

	public function columnMap() {
		return array(
			'id'      	=> 'id', 
			'email'   	=> 'email', 
			'fullname'  => 'fullname', 
			'status'    => 'status',
			'editor_id' => 'editor_id',
			'created'   => 'created',
			'updated'   => 'updated'
		);
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl("newsletter/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 'email',
				'label' 	=> 'Địa chỉ email',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'status',
				'label' 	=> 'Trạng thái',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Chưa xem',1=>'Đã xem')
				)
			),
			array (
				'name'  	=> 'created',
				'label' 	=> 'Ngày nhận tin',
				'width' 	=> '120px',
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
			'select' => ['email','status','created','id']
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'view' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'email'     => $item->email,
				'created'   => $item->created,
				'status'  	=> $this->changeValue('status', $item->id, $item->status, 'newsletter'),
				'id'     		=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}