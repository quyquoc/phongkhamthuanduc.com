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
	public function indexAction($code=null) {
		$this->view->menu 	= 'dich-vu';
		if(!empty($code)) {
			$this->detail($code);
		}else{
			$service = ServiceModel::find(array(
				"conditions"	=> "status = 1",
				"order"			=> "id ASC"
			));
			$this->view->list_item = $service;
		}
	}
	private function detail($code) {
		$item = ServiceModel::findFirstByCode($code);
		if($item){
			
			$article = $item;
			$article->hits++;
			$article->save();
			$this->view->head = array(
				'title'			=> !empty($article->seo_title) ? $article->seo_title : $article->title,
				'description'	=> !empty($article->seo_description) ? $article->seo_description : $article->description,
				'image'		 	=> !empty($article->seo_image) ? $article->seo_image : $article->image,
				'url'		 	=> $this->url->get("/dich-vu/".$item->code)
			);
			$service = ServiceModel::find(array(
				"conditions"	=> "status = 1 and id !=$article->id",
				"order"			=> "id ASC"
			));
			$this->view->list_relative = $service;
			$this->view->article 	= $item;
			$this->view->menu_lv1 	= $item->code;
			$this->view->pick("service/detail");
		}else {$this->response->redirect('/dich-vu');}
	}
}