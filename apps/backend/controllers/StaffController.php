<?php
namespace Modules\Backend\Controllers;

class StaffController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model 	= "\Modules\App\Models\StaffModel";
		$this->form   = "\Modules\App\Forms\StaffForm";
		$this->view->_controller = 'Nhân sự';
		$this->view->col_order 		= 4;
	}
	
	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		parent::dataUpdate($request, $id, function($model){
			return $model;
		});
		return $this->view->pick('staff/index');
	}
}

