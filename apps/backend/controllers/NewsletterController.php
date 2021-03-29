<?php
namespace Modules\Backend\Controllers;

class NewsletterController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model 	= "\Modules\App\Models\NewsletterModel";
		$this->form 	= "\Modules\App\Forms\NewsletterForm";
		$this->view->_controller 	= 'Đăng ký nhận tin';
		$this->view->col_order 		= 2;
	}

	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		parent::dataUpdate($request, $id, function($model){
			$model->status = 1;
			return $model;
		});
		return $this->view->pick('newsletter/index');
	}
}