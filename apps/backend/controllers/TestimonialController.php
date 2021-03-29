<?php
namespace Modules\Backend\Controllers;

class TestimonialController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model = "\Modules\App\Models\TestimonialModel";
		$this->form = "\Modules\App\Forms\TestimonialForm";
		$this->view->_controller = 'Ý kiến đánh giá ';
		$this->view->col_order   = 4;
	}
	
	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		parent::dataUpdate($request, $id, function($model){
			return $model;
		});
		return $this->view->pick('testimonial/index');
	}
}

