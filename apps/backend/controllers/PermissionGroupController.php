<?php
namespace Modules\Backend\Controllers;

class PermissionGroupController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model = "\Modules\App\Models\PermissionGroupModel";
		$this->form = "\Modules\App\Forms\PermissionGroupForm";
		$this->view->_controller 	= 'Nhóm quyền';
	}

	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
    parent::dataUpdate($request, $id, function($model){
      return $model;
    });
    return $this->view->pick('permission-group/index');
	}
}

