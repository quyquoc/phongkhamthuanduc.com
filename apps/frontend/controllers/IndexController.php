<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}

	public function indexAction() {
		$this->view->page = "home";
	}

	public function maintainAction(){
		$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
		$this->view->pick('index/maintain');
	}

	public function pageAction() {
		$this->view->menu = "page";
	}

	public function componentsAction() {
		$this->view->menu = "components";
	}

	public function boxesAction() {
		$this->view->menu = "boxes";
	}
}

