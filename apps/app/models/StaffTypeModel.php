<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class StaffTypeModel extends DatatableManagerModel {

	public function getSource() {
		return "staff_type";
	}

	public function columnMap() {
    return array(
      'id'            => 'id', 
      'name'         => 'name',
    );
  }
    
  public function initialize() {}

	private function getController() {
		return "staff-type";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	/*public function beforeSave() {
		if(!isset($this->id) || !($this->id >0)){
			$this->created = date("Y-m-d H:i:s");
		}
	}*/

	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 'ig@name',
				'label' 	=> 'Chủ đề ảnh',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),	
			// array (
			// 	'name'		=> 'ig@status',
			// 	'label' 	=> 'Hiển thị',
			// 	'width'		=> '80px',
			// 	'filter'	=> array(
			// 		'type' 	=> 'select',
			// 		'value' => array(0=>'Không',1=>'Có')
			// 	)
			// ),
			array (
				'name'  	=> 'ig@id',
				'label' 	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}
	
  public function datatable_json_data() {
		$result = $this->datatable_find([
			'select' 		=> ['st.name', 'st.id'],
			'from' 			=> ['st' => 'Modules\App\Models\ImageGroupModel']
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'ig@title'  	=> $item->title,
				// 'ig@status'   => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'ig@id'     	=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}