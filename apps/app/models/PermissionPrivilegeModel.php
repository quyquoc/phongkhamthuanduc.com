<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;

class PermissionPrivilegeModel extends DatatableManagerModel {

	public function getSource() {
		return "permission_privilege";
	}

	public function columnMap() {
		return array(
			'id'            =>  'id', 
			'name'          =>  'name', 
			'controller'    =>  'controller',
			'action'        =>  'action',
			'status'        =>  'status', 
			'position'      =>  'position'
		);
	}
	
	public function initialize(){}
	
	public function sql(){
		return "SELECT id,name,controller,action AS action_this,status,position FROM \Modules\App\Models\PermissionPrivilegeModel";
	}

	public function json_data($option = null){
		$json_data = array(
			array(
				"data"      => "name",
				"title"     => $this->getDI()->getLanguage()->_('name'),
				"search"    => array(
					"type"  => "text"
				)
			),
			array(
				"data"      => "controller",
				"title"     => $this->getDI()->getLanguage()->_('controller'),
				"search"    => array(
					"type"  => "text"
				)
			),
			array(
				"data"      => "action_this",
				"title"     => $this->getDI()->getLanguage()->_('action_this'),
				"search"    => array(
					"type"  => "text"
				)
			),
			array(
				"data"      => "status",
				"title"     => $this->getDI()->getLanguage()->_('status'),
				"search"    => array(
					"type"  => "select",
					"value" => array(''=>'','0'=>'Đóng','1'=>'Mở')
				)
			),
			array(
				"data"      => "action",
				"title"     => '<a class="btn btn-success add-new" href="'.BACKEND_URL.'/permission-privilege/add"><i class="fa fa-plus m-right-xs"></i> '.$this->getDI()->getLanguage()->_('add_new').'</a>',
				"orderable" => false,
				"width"     => "10%",
				"search"    => array(
					"type"  => "button-add",
					"value" => '<a class="btn btn-success add-new" href="'.BACKEND_URL.'/permission-privilege/add"><i class="fa fa-plus m-right-xs"></i> '.$this->getDI()->getLanguage()->_('add_new').'</a>'
				)
			)
		);
		
		return $option == null ? preg_replace('/[\[\]]/','',json_encode($json_data)) : json_encode($json_data);
	}
}