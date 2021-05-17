<?php
namespace Modules\Backend\Controllers;

class ServiceController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model 	= "\Modules\App\Models\ServiceModel";
		$this->form 	= "\Modules\App\Forms\ServiceForm";
		$this->view->_controller 	= 'Dịch vụ';
		$this->view->col_order 		= 4;
	}

	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		parent::dataUpdate($request, $id, function($model){
			$model->code = $this->request->getPost("code");

			$model->code = !empty($model->code) ? $model->code : $model->createSlug('title', 'code');
			$model->status = 1;
		  return $model;
		});
		return $this->view->pick('service/index');
	}
}