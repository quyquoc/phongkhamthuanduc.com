<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class BookingModel extends DatatableManagerModel {
	
	public function getSource() {
		return "booking";
	}

	public function columnMap() {
		return array(
			'id'       		=> 'id', 
			'fullname'  	=> 'fullname', 
			'email'     	=> 'email',
			'phone'     	=> 'phone', 
			'from_date' 	=> 'from_date',
			'from_time'  	=> 'from_time',
			'department_title' => 'department_title',
			'status'    	=> 'status',
			'editor_id' 	=> 'editor_id',
			'updated'   	=> 'updated',
			'created'   	=> 'created'
		);
	}
	
	public function initialize(){
		$this->belongsTo('department_id', '\Modules\App\Models\DepartmentModel', 'id', ['alias' => 'depart']);
	}
	
	public function getController() {
		return "booking";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}
	
	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 'b@fullname',
				'label' 	=> 'Họ và tên',
				'filter'	=> array(
					'type'	=> 'text'
				)
			),
			array (
				'name'		=> 'b@status',
				'width'		=> '80px',
				'label' 	=> 'Hiển thị',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name'		=> 'b@from_date',
				'label' 	=> 'Ngày ở',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'b@department_title',
				'label' 	=> 'Ngày đi',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'b@created',
				'width'		=> '100px',
				'label' 	=> 'Ngày đăng ký',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 'b@id',
				'label'		=> 'Hành động',
				'width'		=> '100px'
			)
		);
		return $init_data;
	}

	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['b.fullname', 'b.status', 'b.from_date', 'b.department_title', 'b.created', 'b.id'],
			'from' 			=> ['b' => 'Modules\App\Models\BookingModel'],
	
		]);

		$result->json_data = array();
		foreach($result->realData as $item){
			$action = array(
				'view' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);			
			$result->json_data[] = array(
				'b@fullname' 			=> $item->fullname,
				'b@status'   			=> $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'b@from_date' 			=> $item->from_date,
				'b@department_title' 			=> $item->department_title,
				'b@created' 			=> $item->created,
				'b@id'					=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

}