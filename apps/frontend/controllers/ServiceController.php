<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;
use Modules\App\Models\ServiceModel;
use Modules\App\Models\ServiceCategoryModel;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Paginator\Pager;
class ServiceController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
		
	}
	public function indexAction() {
		$this->view->menu 	= 'dich-vu';
		$service = ServiceModel::find(array(
			"conditions"	=> "status = 1",
			"order"			=> "id ASC"
		));
		$this->view->list_item = $service;
	}
}