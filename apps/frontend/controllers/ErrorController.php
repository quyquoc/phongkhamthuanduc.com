<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;

class ErrorController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}

	public function show401Action(){

		$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
	}

	public function show404Action(){

		$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
	}
}
