<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class PermissionGroupModel extends DatatableManagerModel {

	public function getSource() {
		return "permission_group";
	}

	public function columnMap() {
		return array(
			'id'            =>  'id', 
			'name'          =>  'name', 
			'permission'    =>  'permission',
			'status'        =>  'status'
		);
	}
	
	public function initialize(){
	}

	private function getController() {
		return "permission-group";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 'name',
				'label' 	=> 'Nhóm',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),	
			array (
				'name'		=> 'permission',
				'label' 	=> 'Quyền',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),	
			array (
				'name'		=> 'status',
				'label' 	=> 'Hiển thị',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name'  	=> 'id',
				'label' 	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}
	
  public function datatable_json_data() {
		$result = $this->datatable_find([
			'select' 		=> ['name', 'permission', 'status', 'id'],
			'from' 			=> ['Modules\App\Models\PermissionGroupModel'],
			'where'			=> ['name != "Founder" and name != "Administrator"']
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'name'  			=> $item->name,
				'permission'  => $item->permission,
				'status'   		=> $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'id'     			=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

	public function list_item() {

		$list = array();
		$list_item =  $this->find(array(
			"conditions"	=> "name != 'Founder'",
			"order"				=> "name ASC"
		));
		foreach ($list_item as $value) {
			$list[$value->name]    = $value->name;
		}

		return $list;
	}
	
	// public function sql(){
	// 	return "SELECT G.id AS id,G.name AS group_name,G.permission AS group_permission,G.status AS status,R.name AS resource_name FROM \Modules\App\Models\PermissionGroupModel AS G JOIN \Modules\App\Models\PermissionResourceModel AS R ON G.resource_id = R.id";
	// }

	// public function json_data($option = null){

	// 	$json_data = array(
	// 		array(
	// 			"data"      =>"group_name",
	// 			"title"     => $this->getDI()->getLanguage()->_('group_name'),
	// 			"search"    => array(
	// 				"type"  => "text"
	// 			)
	// 		),
	// 		array(
	// 			"data"      =>"group_permission",
	// 			"title"     => $this->getDI()->getLanguage()->_('authorities'),
	// 			"search"    => array(
	// 				"type"  => "text"
	// 			)
	// 		),
	// 		array(
	// 			"data"      =>"status",
	// 			"title"     => $this->getDI()->getLanguage()->_('status'),
	// 			"search"    => array(
	// 				"type"  => "text"
	// 			)
	// 		)
	// 		array(
	// 			"data"      => "action",
	// 			"title"     => '<a class="btn btn-success add-new" href="'.BACKEND_URL.'/permission-group/add"><i class="fa fa-plus m-right-xs"></i> '.$this->getDI()->getLanguage()->_('add_new').'</a>',
	// 			"orderable" => false,
	// 			"width"     => "10%",
	// 			"search"    => array(
	// 				"type"  => "button-add",
	// 				"value" => '<a class="btn btn-success add-new" href="'.BACKEND_URL.'/permission-group/add"><i class="fa fa-plus m-right-xs"></i> '.$this->getDI()->getLanguage()->_('add_new').'</a>'
	// 			)
	// 		)
	// 	);
		
	// 	return $option == null ? preg_replace('/[\[\]]/','',json_encode($json_data)) : json_encode($json_data);
	// }
}