<?php
namespace Modules\Backend\Controllers;
use \Modules\App\Forms\MemberForm as Form_Member;

class AccountController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
		// $this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
		$this->view->_controller = 'Tài khoản';
	}
	
	public function profileAction(){

		$this->view->_action = 'Thông tin';
		$this->assets->addJs('/library/cropping/cropper.min.js')
								 ->addJs('/library/cropping/main.js');

		$form = new Form_Member();
		$this->view->form = $form;
	}

	public function editProfileAction(){

		$this->assets->addJs('/library/input-mask/jquery.inputmask.js')
								 ->addJs('/library/input-mask/jquery.inputmask.date.extensions.js')
								 ->addJs('/library/input-mask/jquery.inputmask.extensions.js');

		$model 	= \Modules\App\Models\MemberModel::findFirstById($this->member->item->id);
		$form 	= new Form_Member($model);
		if($this->request->isPost() == true) {
			$_POST['birthday'] = date("Y-m-d", strtotime($this->request->getPost("birthday")));
			$form->bind($_POST, $model); 
			$model->save();
		}
		$this->view->form = $form;
	}

	public function changePasswordAction(){
		$form = new Form_Member();
		$form->add(new \Phalcon\Forms\Element\Password("password_new"));
		if ($this->request->isPost() == true) { 
			$password_current = $this->request->getPost("password");
			$password = \Modules\Library\Oh\Hash::create($password_current,$this->member->item->salt);
			if(strcmp($password, $this->member->item->password) == 0){
				$password_new = $this->request->getPost("password_new");
				if(!empty($password_new)){
					$this->member->item->password = \Modules\Library\Oh\Hash::create($password_new,$this->member->item->salt); 
					$this->member->item->save();
					$this->flashSession->success($this->language->_('password_success'));
				} else {
					$this->flashSession->error($this->language->_('vali_empty'));
				}
			} else{
				$this->flashSession->error($this->language->_('password_fail'));
			}
		}
		$this->view->form = $form;
	}

	public function editAvatarAction(){
		if($this->request->isPost() == true) {
			if(!empty($_FILES['avatar_file']['name'])){
				$name 		= $_FILES['avatar_file']['name'];
				$type 		= $_FILES['avatar_file']['type'];
				$tmp_name = $_FILES['avatar_file']['tmp_name'];
				$path 		= ROOT_PATH.'/public/files/avatar/'.$name;
				if(move_uploaded_file($tmp_name,$path)){
					$this->member->item->avatar = $name;
					$this->member->item->save();
				}
				print_r($_FILES);
				print_r($_POST);
			}
		}
	}

	public function logoutAction(){
		$auth = new \Modules\Library\Auth\Auth();
		$auth->remove();
		$this->response->redirect($this->define->backend);
	}
}

