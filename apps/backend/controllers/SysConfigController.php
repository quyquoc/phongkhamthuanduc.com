<?php
namespace Modules\Backend\Controllers;

class SysConfigController extends BackendController {

	protected function onConstruct(){
		$this->model 	= "\Modules\App\Models\SysConfigModel";
		$this->form 	= "\Modules\App\Forms\SysConfigForm";
		parent::onConstruct();
		$this->view->_controller 	= 'Cấu hình';
		$this->view->sort   			= 'asc';
		$this->view->page_length  = 50;
	}

	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		parent::dataUpdate($request, $id, function($model) {
			return $model;
		});
		return $this->view->pick('sys-config/index');
	}

}

