<?php
namespace Modules\Backend\Controllers;

class QaController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model 	= "\Modules\App\Models\QaModel";
		$this->form 	= "\Modules\App\Forms\QaForm";
		$this->view->_controller 	= 'Tư vấn - Hỏi đáp';
		$this->view->col_order 		= 4;
	}
	
	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		parent::dataUpdate($request, $id, function($model){
			$model->code = $this->request->getPost("code");
			$model->code = !empty($model->code) ? $model->code : $model->createSlug('question', 'code');
			return $model;
		});
		return $this->view->pick('qa/index');
	}
}

