<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;
use Modules\App\Models\DepartmentModel;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Paginator\Pager;
class DepartmentController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
		
	}
	public function indexAction($code=null) {
		$this->view->menu 	= 'chuyen-khoa';
		if(!empty($code)) {
			$this->detail($code);
			$this->depart();
		}else{
			$this->depart();
		}
	}
	private function detail($code) {
		$item = DepartmentModel::findFirstByCode($code);
		if($item){
			
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
			$this->view->pick("department/detail");
		}else {$this->response->redirect('/chuyen-khoa');}
	}
	private function depart(){
		$depart = DepartmentModel::find(array(
			"conditions" => "status",
			"order"		 => "id ASC",
		));
		$this->view->list_depart = $depart;
	
	}
}