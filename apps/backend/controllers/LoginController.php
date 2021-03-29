<?php
namespace Modules\Backend\Controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class LoginController extends Controller {

	protected function onConstruct(){
		
		$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT);
	}

	public function indexAction() {
		
		$auth = $this->session->get('auth-oh');
		if(isset($auth)){
			$this->response->redirect($this->define->backend."/index");
		}
		$form = new \Modules\App\Forms\LoginForm();

		if ($this->request->isPost() == true) {
			if ($form->isValid($this->request->getPost())) {
				$auth = new \Modules\Library\Auth\Auth();
				$check = $auth->check(array(
					'username' => $this->request->getPost('username'),
					'password' => $this->request->getPost('password'),
				));
				
				if($check){ // Đăng nhập thành công
					$this->response->redirect($this->define->backend."/index");
				} else { // Đăng nhập thất bại
					$this->flashSession->error('* Tên đăng nhập hoặc mật khẩu không đúng!');
					$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName());
				}
			}
		}
		$this->view->form = $form;
	}
}

