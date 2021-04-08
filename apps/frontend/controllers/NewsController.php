<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Paginator\Pager;
use Modules\App\Models\NewsArticleModel;
use Modules\App\Models\ImageModel;
use Modules\App\Models\ImageAlbumModel;
use Modules\App\Models\NewsCategoryModel;
use Modules\App\Models\NewsArticleCategoryModel;

class NewsController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}

	public function indexAction($category_code = null, $code = null) {
		if($category_code == 'gioi-thieu') {
		
			$this->about();
		}
		elseif($category_code == 'kham-bao-hiem-y-te') {
			$this->view->menu =  'kham-bao-hiem-y-te';
			
			$this->detail($category_code);
		}
		else {
			$this->news($category_code, $code);
		}
	}

	private function news($category_code = null, $code = null) {
		$this->view->menu = 'tin-tuc';
		if(!empty($code)){// hien thi chi tiet
			$this->detail($code);
		}else{
			// $category_code = $category_code ? $category_code : 'tin-tuc';
			$category = NewsCategoryModel::findFirst(array(
				'conditions'	=> 'code = :code: and status = 1',
				'bind'				=> array('code'=>$category_code)
			));
			$this->view->category = $category;
			$this->view->menu = $this->view->category_code = $category->code;

			if(!empty($category)){
				$list_item = NewsArticleModel::init()->newsWithCategory($category->code, ['limit'=>12]);
				if($list_item && count($list_item) > 0) {
					$head = array(
						'title'			=> $category->title,
						'description'	=> $category->description,
						'image'			=> $category->image,
						'url'			=> $this->url->get('/'.$category->code)
					);

					$this->view->setVar('head', $head);
					$this->view->setVar('list_item', $list_item);
					$this->view->pick('news/category');
				}else {$this->response->redirect();}
			}else {$this->response->redirect();}
		}
	}

	private function about() {
		$this->view->menu = 'gioi-thieu';
		$album = ImageAlbumModel::findFirstByCode('chung-chi');
		$this->view->certificate = ImageModel::find(array(
			"conditions" => "status = 1 and album_id = {$album->id}",
		 	"order" => "created DESC",
			));
			
		$this->view->pick('news/about');
	}
	private function detail($code) {
		$item = NewsArticleModel::init()->newsDetailWithCode($code);
		if($item){
			// update hits
			$article = NewsArticleModel::findFirstByCode($item->code);
			$article->hits++;
			$article->save();

			// tin cung loai
			$list_relative = NewsArticleModel::init()->newsWithCategory($item->category_code, ['limit'=>12]);
			$this->view->list_relative = $list_relative;

			$this->view->head = array(
				'title'				=> !empty($article->seo_title) ? $article->seo_title : $article->title,
				'description'	=> !empty($article->seo_description) ? $article->seo_description : $article->description,
				'image'		 		=> !empty($article->seo_image) ? $article->seo_image : $article->image,
				'url'		 			=> $this->url->get("/".$item->category_code."/".$item->code)
			);

			$category = NewsCategoryModel::findFirst(array(
				'conditions'	=> 'code = :code: and status = 1',
				'bind'				=> array('code'=>$item->category_code)
			));

			$this->view->article 	= $item;
			$this->view->category = $category;
			$this->view->menu_lv1 	= $this->view->category_code = $item->category_code;
			// $this->view->category_title = $item->category_title;
			$this->view->pick("news/detail");
		}
		else { $this->response->redirect(); }
	}
	public function addItemAction(){

		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

		if ($this->request->isAjax()) {
			
			$category_code 	= !empty($this->request->get('category_code')) ? $this->request->get('category_code') : '';
			$limit					= !empty($this->request->get('limit')) ? $this->request->get('limit') : 12;
			$offset					= !empty($this->request->get('offset')) ? $this->request->get('offset') : 0;
			
			$list_item = NewsArticleModel::init()->newsWithCategory($category_code, ['limit'=>$limit, 'offset'=>$offset]);
			$this->view->list_item = $list_item;
		}
	}
}
