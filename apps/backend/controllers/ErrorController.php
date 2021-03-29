<?php

namespace Modules\Backend\Controllers;
use Phalcon\Mvc\Controller;

class ErrorController extends Controller {

	public function indexAction() {		
	}

	public function error401Action(){
		$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
	}

	public function error404Action(){
		// $this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
		// $this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT);
		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
	}
}

