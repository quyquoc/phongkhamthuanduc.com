<?php
namespace Modules\Backend\Controllers;

class ImageGroupController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model = "\Modules\App\Models\ImageGroupModel";
		$this->form = "\Modules\App\Forms\ImageGroupForm";
		$this->view->_controller 	= 'Chủ đề ảnh';
		$this->view->col_order 		= 4;
	}
	
	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
    parent::dataUpdate($request, $id, function($model){
      $model->code = $this->request->getPost("code");
      $model->code = $model->createSlug('title','code');
      return $model;
    });
    return $this->view->pick('image-group/index');
	}
}

