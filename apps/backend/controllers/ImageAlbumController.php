<?php
namespace Modules\Backend\Controllers;

class ImageAlbumController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model = "\Modules\App\Models\ImageAlbumModel";
		$this->form = "\Modules\App\Forms\ImageAlbumForm";
		$this->view->_controller 	= 'Bộ sưu tập ảnh';
		$this->view->col_order 		= 5;
	}
	
	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
    parent::dataUpdate($request, $id, function($model){
      $model->code = $this->request->getPost("code");
      $model->code = $model->createSlug('title','code');
      return $model;
    });
    return $this->view->pick('image-album/index');
	}
}

