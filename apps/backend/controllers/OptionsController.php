<?php

namespace Modules\Backend\Controllers;

use \Modules\Backend\Forms\Member as Form_Member;

class OptionsController extends ControllerBase
{
	
	protected function initialize(){
		parent::initialize();
		$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
		
	}

	public function indexAction()
	{
		
	}

	/**
	 * Reset mật khẩu tài khoản
	 */
	public function resetPasswordAction($id){
		$this->setModel('Member');
		$model = $this->findFirstById($id);
		$this->view->username = $model->username;
		$form = new Form_Member();
		$form->add(new \Phalcon\Forms\Element\Password("password_new"));
		$this->view->form = $form;
		if ($this->request->isPost() == true) { 
			$password_new = $this->request->getPost("password_new");
			if(!empty($password_new)){
				$model->password = \Modules\Backend\Library\Ohue\Hash::create($password_new,$model->salt); 
				$model->save();
				$this->flashSession->success($this->language->_('password_success'));
			} else {
				$this->flashSession->error($this->language->_('vali_empty'));
			}
		}
	}
}