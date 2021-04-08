<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;
use Modules\App\Models\NewsArticleModel;
class IndexController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
		
	}

	public function indexAction() {
		$this->view->page = "home";
		$this->view->list_item = NewsArticleModel::find(array(
			"conditions" => "status = 1 and code!= 'kham-bao-hiem-y-te' ",
			"order"		 => " featured DESC, published DESC, created DESC",
			"limit"		 => 6
		));
	}
}

