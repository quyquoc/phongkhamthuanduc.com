<?php
namespace Modules\Backend\Controllers;
use \Modules\Library\Oh\Hash;
use Modules\App\Models\MemberModel;
use Modules\App\Forms\MemberForm;

class MemberController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		$this->model 	= "\Modules\App\Models\MemberModel";
		$this->form 	= "\Modules\App\Forms\MemberForm";
		$this->view->_controller = 'Thành viên';
	}

	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
    parent::dataUpdate($request, $id, function($model){
			if(empty($id)){
				$salt = \Modules\Library\Oh\Hash::random();
				$password = $this->request->getPost("password");
				$model->password = Hash::create($password,$salt);
				$model->salt = $salt;
			}
			return $model;
		});
		return $this->view->pick('member/index');
	}
}

