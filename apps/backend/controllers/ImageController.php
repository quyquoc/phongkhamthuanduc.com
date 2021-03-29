<?php
namespace Modules\Backend\Controllers;

class ImageController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
    $this->model  = "\Modules\App\Models\ImageModel";
    $this->form   = "\Modules\App\Forms\ImageForm";
		$this->view->_controller = 'Hình ảnh';
    $this->view->col_order    = 5;
  }

  public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
    parent::dataUpdate($request, $id, function($model){
      $model->code = $this->request->getPost("code");
      $model->code = $model->createSlug('title', 'code');

      //IMGS UPDATE
      $is     = $this->request->getPost("is"); // kiem tra co check default
      $img    = $this->request->getPost("img"); // mang image
     
      $ch         = 0;
      $im_json    = array();

      for ($i = 0; $i < count($img) ; $i++) {
        $item['src'] = $img[$i];
        if($img[$i] == $is){
          $ch = 1;
          $item['default'] = 1;
          $data['image'] = $img[$i];
        }else{
          $item['default'] = 0;
        }
        $im_json[] = $item;
      }

      if(!empty($im_json) && $ch == 0){
        $im_json[0]['default']  = 1;
        $data['image']          = $im_json[0]['src'];
      }

      $js_img = json_encode($im_json);
      $model->imgs  = $js_img;
      $model->image = !empty($data['image']) ? $data['image'] : null;

      return $model;
    });
    return $this->view->pick('image/index');
  }
}

