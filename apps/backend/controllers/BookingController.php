<?php
namespace Modules\Backend\Controllers;

class BookingController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model 	= "\Modules\App\Models\BookingModel";
		$this->form 	= "\Modules\App\Forms\BookingForm";
		$this->view->_controller 	= 'Đặt lịch khám';
		$this->view->col_order 		= 4;
	}
	
	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		$hello = parent::dataUpdate($request, $id, function($model){
			$model->status = 1;
			return $model;
		});
		return $this->view->pick('booking/index');
	}
}

