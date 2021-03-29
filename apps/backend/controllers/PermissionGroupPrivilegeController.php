<?php
namespace Modules\Backend\Controllers;

class PermissionGroupPrivilegeController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->setModel("PermissionGroupPrivilegeModel");
		$this->view->_controller = 'Phân quyền';
		$this->view->action = array(
			"index"     =>  $this->language->_('view'),
			"edit"      =>  $this->language->_('edit'),
			"add"       =>  $this->language->_('add'),
			"delete"    =>  $this->language->_('delete'),
		);
	}

	public function indexAction() { 

		$options = array(
			"search"    =>  "group_id",
			"order"     =>  "group_id asc"
		);       

		$da 		= \Modules\App\Models\PermissionGroupPrivilegeModel::find();
		$role 	= array();
		$group 	= \Modules\App\Models\PermissionGroupModel::find(array("conditions"=>"name != 'Administrator'"));
		foreach ($da as $key => $value) {			
			foreach ($group as $k_g => $v_g) {
				if($value->group->id == $v_g->id){
					$role[$value->group->id][$value->privilege->controller][$value->privilege->action] = $value->privilege->action;
				}    
			}
		}
		$this->view->role_view = $role;
		$this->view->group_detail =  new \Modules\Backend\Controllers\PermissionGroupPrivilegeController();
	}

	/**
	 *	Thêm mới và edit quyền của group
	 */
	public function addAction(){
		
		$this->view->_action = 'Thêm mới';
		
		$this->assets->addCss('/backend/template/css/switchery/bootstrap-switch.min.css');
		$this->assets->addJs('/backend/template/js/switchery/bootstrap-switch.min.js');
		
		$item =  \Modules\App\Models\PermissionGroupPrivilegeModel::find();
		
		$role = array();
		$group = \Modules\App\Models\PermissionGroupModel::find(array("conditions"=>"name != 'Administrator'"));

		foreach ($group as $key => $value) {
			$flash = false;
			if($value->permission != "full"){
				foreach ($item as $key_item => $value_item) {
					if($value->id == $value_item->group_id){
						$role[$value->id][$value_item->privilege->controller][$value_item->privilege->action] = $value_item->privilege->action;
						$flash = true;
					} 
				}
				if($flash == false){
					$role[$value->id] = array();
				}
			}
		}
		$this->view->role_view = $role;
		$privilege = \Modules\App\Models\PermissionPrivilegeModel::find();
		$pri_active = array();
		foreach ($privilege as $key => $value) {
			if(array_key_exists($value->controller,$pri_active)){
				$pri_active[$value->controller][$value->action] = $value->action;
			} else {
				$pri_active[$value->controller][$value->action] = $value->action;
			}
		}
		$this->view->pri_active = $pri_active;
		// Xử lý cấp quyền
		if ($this->request->isPost() == true) {
			if($this->request->getPost("my") != null){
				$data = $this->request->getPost("my");
				foreach ($data as $key => $value) {
					$item =  \Modules\App\Models\PermissionGroupPrivilegeModel::find(array(
						"conditions"    =>  "group_id = ?1",
						"bind"          =>  array(1 => $key)    
					));
					foreach ($item as $key_item => $value_item) {
						$value_item->delete();
					}
					foreach ($value as $key_controller => $value_controller) {
						foreach ($value_controller as $key_action => $value_action) {
							$privilege_item = \Modules\App\Models\PermissionPrivilegeModel::find(array("conditions" => "controller =?1 AND action = ?2","bind" => array(1 => $key_controller,2 => $key_action)));     
							if(!empty($privilege_item) && count($privilege_item) > 0){
								foreach ($privilege_item as $key_permission => $value_permission) {
									$group_privilege_item = new \Modules\App\Models\PermissionGroupPrivilegeModel();
									$group_privilege_item->privilege_id = $value_permission->id;
									$group_privilege_item->group_id = $key;
									$group_privilege_item->status = 1;
									$group_privilege_item->save();
								}
							}
						} 
					}
				}    
				$this->flashSession->success($this->language->_('alert_success'));
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
			} else {
				$this->flashSession->success($this->language->_('alert_success'));
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
			}
		}
		$this->view->group_detail =  new \Modules\Backend\Controllers\PermissionGroupPrivilegeController();
	}

	/**
	 * Hàm chỉnh sửa quyền của group 
	 */
	public function editAction($id = null){

		$this->view->_action = 'Chỉnh sửa';

		$this->assets->addCss('backend/template/css/switchery/bootstrap-switch.min.css');
		$this->assets->addJs('backend/template/js/switchery/bootstrap-switch.min.js');        
		
		$this->view->group_id = $id;
		$item =  \Modules\App\Models\PermissionGroupPrivilegeModel::find(array(
			"conditions"    =>  "group_id = ?1",
			"bind"          =>  array(1 => $id)    
		));
		
		$role = array();
		$group = \Modules\App\Models\PermissionGroupModel::find();
		foreach ($item as $key => $value) {
			$role[$value->group->name][$value->privilege->controller][$value->privilege->action] = $value->privilege->action;
		}
		$this->view->role_view = $role;
		$privilege = \Modules\App\Models\PermissionPrivilegeModel::find();
		$pri_active = array();
		foreach ($privilege as $key => $value) {
			if(array_key_exists($value->controller,$pri_active)){
				$pri_active[$value->controller][$value->action] = $value->action;
			} else {
				$pri_active[$value->controller][$value->action] = $value->action;
			}
		}
		$this->view->pri_active = $pri_active;
		// Xử lý cấp quyền
		if ($this->request->isPost() == true) {
			$item =  \Modules\App\Models\PermissionGroupPrivilegeModel::find(array(
				"conditions"    =>  "group_id = ?1",
				"bind"          =>  array(1 => $id)    
			));
			foreach ($item as $key => $value) {
				$value->delete();
			}
			if($this->request->getPost("my") != null){
				$data[] = $this->request->getPost("my");
				foreach ($data as $key => $value) {
					foreach ($value as $key_controller => $value_controller) {
						foreach ($value_controller as $key_action => $value_action) {
							$privilege_item = \Modules\App\Models\PermissionPrivilegeModel::find(array("conditions" => "controller =?1 AND action = ?2","bind" => array(1 => $key_controller,2 => $key_action)));     
							if(!empty($privilege_item) && count($privilege_item) > 0){
								foreach ($privilege_item as $key_permission => $value_permission) {
									$group_privilege_item = new \Modules\App\Models\PermissionGroupPrivilegeModel();
									$group_privilege_item->privilege_id = $value_permission->id;
									$group_privilege_item->group_id = $id;
									$group_privilege_item->status = 1;
									$group_privilege_item->save();
								}
							}
						} 
					}
				}    
				$this->flashSession->success($this->language->_('alert_success'));
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
			} else {
				$this->flashSession->success($this->language->_('alert_success'));
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
			}
		}
	}

	/** 
	 *	Hàm xóa các quyền trong group-privilege
	 */
	public function deleteRoleAction($group_id = null,$privilege_controller = null){
		//lấy group_id theo group_name
		$group = \Modules\App\Models\Permission_group::findFirst(array(
			"conditions"    =>  "id = ?1",
			"bind"          =>  array(1 => $group_id),
			"columns"       =>  "id,name"    
		)); 
		// lấy mã privilege_id theo privilege_controller 
		$privilege =  \Modules\App\Models\PermissionPrivilegeModel::find(array(
			"conditions"    =>  "controller = ?1",
			"bind"          =>  array(1 => $privilege_controller),
			"columns"       =>  "id,controller"    
		)); 
		if($group && $privilege){
			foreach ($privilege as $key => $value) {
				$item =  \Modules\App\Models\PermissionGroupPrivilegeModel::findFirst(array(
					"conditions"    =>  "privilege_id = ?1 AND group_id = ?2",
					"bind"          =>  array(1 => $value->id,2 => $group->id)    
				));
				if(count($item) > 0 && !empty($item)){
					$this->delete($item->id);
				} 
			}
		}
	}

	/*
	*   Hàm lấy thông tin group
	*
	**/
	public function getDetailGroup($id){
		return  $group = \Modules\App\Models\PermissionGroupModel::findFirst(array(
			"conditions"    =>  "id = ?1",
			"bind"          =>  array(1 => $id),
			"columns"       =>  "id,name"    
		)); 
	}
}