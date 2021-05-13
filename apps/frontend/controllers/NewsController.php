<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Paginator\Pager;
use Modules\App\Models\NewsArticleModel;
use Modules\App\Models\ImageModel;
use Modules\App\Models\ImageAlbumModel;
use Modules\App\Models\NewsCategoryModel;
use Modules\App\Models\NewsArticleCategoryModel;
use Modules\App\Models\StaffModel;
use Modules\App\Models\DepartmentModel;
class NewsController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}

	public function indexAction($category_code = null, $code = null) {
		if($category_code == 'gioi-thieu') {
			$this->view->menu = 'gioi-thieu';
			if(!empty($code)) {
				$this->view->menu_lv1 = $code;
				if($code=='nhan-luc-phong-kham'){
					$this->view->list_staff= StaffModel::find(array(
						"conditions"	=> "status = 1",
						"order"			=> "type_id ASC, position ASC, id ASC"
					));
					$list_depart = DepartmentModel::find(array('conditions' => 'status = 1 ', 'order'=> 'position ASC, id ASC',));
					foreach ($list_depart as $key => $item) {
						
						$arr_category[$key] = $item->toArray();
						$list_staff = StaffModel::find(array(
							'conditions' 	=> 'status = 1 and department_id = :department_id:',
							'bind'			=> array('department_id' => $item->id),
							'order'			=> 'manager DESC, id ASC',
						));
						$arr_category[$key]['list_staff'] = $list_staff;
					}
					$this->view->arr_category = $arr_category;
					$this->view->pick('news/staff');
				}else{
					$this->detail($code);
				}
			}else{
				$this->about();
			}
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
			if($category_code == 'tin-tuc') {
				$gioithieu = NewsCategoryModel::findFirstByCode('gioi-thieu');
				$list_item = NewsArticleModel::find(array(
					'conditions'	=> "status = 1 and category_id != $gioithieu->id",
					"order"			=> "published DESC",
					"limit"			=> 12
				));
				$count_item = NewsArticleModel::find(array(
					'conditions'	=> "status = 1 and category_id != $gioithieu->id",
					"order"			=> "published DESC"
				));
				$head = array(
					'title'			=> "Tin tức",
					'url'			=> $this->url->get('/tin-tuc')
				);
			}else{
				$category = NewsCategoryModel::findFirst(array(
					'conditions'	=> 'code = :code: and status = 1',
					'bind'				=> array('code'=>$category_code)
				));
				$this->view->category = $category;
				$this->view->menu_lv1 = $this->view->category_code = $category->code;
				if(!empty($category)){
					$list_item = NewsArticleModel::find(array(
						'conditions'	=> "status = 1 and category_id = $category->id",
						"order"			=> "published DESC",
						"limit"			=> 12
					));
					$count_item = NewsArticleModel::find(array(
						'conditions'	=> "status = 1 and category_id = $category->id",
						"order"			=> "published DESC"
					));
					$head = array(
						'title'			=> $category->title,
						'description'	=> $category->description,
						'image'			=> $category->image,
						'url'			=> $this->url->get('/'.$category->code)
					);
				}
					
			}
			if($list_item && count($list_item) > 0) {
				$this->view->setVar('head', $head);
				$this->view->setVar('list_item', $list_item);
				$this->view->setVar('count_item', $count_item->count());
				$this->view->pick('news/category');
			}else {$this->response->redirect();}
		}
	}

	private function about() {
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
			$category = NewsCategoryModel::findFirstById($article->category_id);
			// tin cung loai
			$list_relative = NewsArticleModel::find(array(
				'conditions'	=> "status = 1 and category_id = $category->id and id!= $article->id",
				"order"			=> "published DESC",
				"limit"			=> 12
			));
			$count_item = NewsArticleModel::find(array(
				'conditions'	=> "status = 1 and category_id = $category->id and id!= $article->id",
				"order"			=> "published DESC"
			));
			$this->view->list_relative = $list_relative;
		
			$this->view->head = array(
				'title'			=> !empty($article->seo_title) ? $article->seo_title : $article->title,
				'description'	=> !empty($article->seo_description) ? $article->seo_description : $article->description,
				'image'		 	=> !empty($article->seo_image) ? $article->seo_image : $article->image,
				'url'		 	=> $this->url->get("/".$category->code."/".$article->code)
			);

			$this->view->article 	= $item;
			$this->view->count_item 	= $count_item->count();
			$this->view->category = $category;
			$this->view->menu_lv1 = $category->code;
			$this->view->pick("news/detail");
		}
		else { $this->response->redirect(); }
	}
	public function addItemAction(){

		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

		if ($this->request->isAjax()) {
			
			$detail_id 	    = !empty($this->request->get('detail_id')) ? $this->request->get('detail_id') : '';
			$category_id 	= !empty($this->request->get('category_id')) ? $this->request->get('category_id') : '';
			$limit			= !empty($this->request->get('limit')) ? $this->request->get('limit') : 6;
			$offset			= !empty($this->request->get('offset')) ? $this->request->get('offset') : 0;
			
			$gioithieu = NewsCategoryModel::findFirstByCode('gioi-thieu');
			$category = NewsCategoryModel::findFirstById($category_id);
			$this->view->category = $category;
			$conditions ="status = 1 and category_id != $gioithieu->id";
			if(!empty($detail_id)){
				$conditions =$conditions . " AND id!= $article->id";
			}
			if(!empty($category_id)){
				$conditions =$conditions . " AND category_id = $category_id";
			}

			
				$list_item = NewsArticleModel::find(array(
					'conditions'	=> $conditions,
					"order"			=> "published DESC",
					"offset" 		=> 	$offset	,
					"limit" 		=> $limit
				));
			
			$this->view->appload = $list_item;
		}
	}
}
