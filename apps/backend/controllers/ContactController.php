<?php
namespace Modules\Backend\Controllers;

class ContactController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model 	= "\Modules\App\Models\ContactModel";
		$this->form 	= "\Modules\App\Forms\ContactForm";
		$this->view->_controller 	= 'Liên hệ';
		$this->view->col_order 		= 4;
	}
	
	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		$hello = parent::dataUpdate($request, $id, function($model){
			$model->status = 1;
			return $model;
		});
		return $this->view->pick('contact/index');
	}
}

