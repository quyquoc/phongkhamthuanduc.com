<?php
namespace Modules\Backend\Controllers;

class NewsCategoryController extends BackendController {

	protected function onConstruct() {
		parent::onConstruct();
    $this->model 	= "\Modules\App\Models\NewsCategoryModel";
    $this->form 	= "\Modules\App\Forms\NewsCategoryForm";
		$this->view->_controller = 'Danh mục tin';
		$this->view->col_order   = 4;
	}

	public function dataUpdate ($request, $id = null, $beforeSave = null, $afterSave = null){
    parent::dataUpdate($request, $id, function($model) {
      $model->code = $this->request->getPost("code");
      $model->code = $model->createSlug('title', 'code');
      return $model;
    });
    return $this->view->pick('news-category/index');
	}
}
