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
	public function detailAction($code) {
		$item = ServiceModel::findFirstByCode($code);
		if($item){
			$this->clinic();
			$article = $item;
			$article->hits++;
			$article->save();
			$this->view->head = array(
				'title'			=> !empty($article->seo_title) ? $article->seo_title : $article->title,
				'description'	=> !empty($article->seo_description) ? $article->seo_description : $article->description,
				'image'		 	=> !empty($article->seo_image) ? $article->seo_image : $article->image,
				'url'		 	=> $this->url->get("/chuyen-khoa/".$item->code)
			);
			$this->view->article 	= $item;
			$this->view->menu_lv1 	= $item->code;
			$this->view->pick("service/detail");
		}else {$this->response->redirect('/chuyen-khoa');}
	}
	public function clinicAction() {
			$this->clinic();
			$this->view->pick("service/clinic");
	}
	private function clinic(){
		$page = $this->dispatcher->getParam('page');
		$this->view->menu = $page ;
		$page = ServiceCategoryModel::findFirstByCode($page);
		$clinic = ServiceModel::find(array(
			"conditions" => "status AND category_id = {$page->id}",
			"order"		 => "published DESC",
		));
		$this->view->category = $page;
		$this->view->clinic = $clinic;
	
	}

	public function serviceAction() {
		$page = $this->dispatcher->getParam('page');
		$this->view->menu = $page ;
		$page = ServiceCategoryModel::findFirstByCode($page);
		$service = ServiceModel::find(array(
			"conditions"	=> "status = 1 and category_id = {$page->id} ",
			"order"			=> "published DESC"
		));
		$this->view->list_item = $service;
	}
}