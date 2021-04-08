<?php
namespace Modules\Backend\Controllers;

class ServiceCategoryController extends BackendController {

	protected function onConstruct() {
		parent::onConstruct();
    $this->model 	= "\Modules\App\Models\ServiceCategoryModel";
    $this->form 	= "\Modules\App\Forms\ServiceCategoryForm";
		$this->view->_controller = 'Khoa bệnh viện';
		$this->view->col_order   = 4;
	}

	public function dataUpdate ($request, $id = null, $beforeSave = null, $afterSave = null){
    parent::dataUpdate($request, $id, function($model) {
      $model->code = $this->request->getPost("code");
      $model->code = $model->createSlug('title', 'code');
      return $model;
    });
    return $this->view->pick('service-category/index');
	}
}
