<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class NewsArticleModel extends DatatableManagerModel {

	public function getSource() {
		return "news_article";
	}

	public function columnMap() {
		return array(
			'id'        			=> 'id', 
			'title'        	 	=> 'title', 
			'code'      			=> 'code', 
			'description'   	=> 'description',
			'content'       	=> 'content',
			'category_id'   	=> 'category_id',
			'featured'      	=> 'featured',
			'image'         	=> 'image',
			'link'						=> 'link',
			'url_target'    	=> 'url_target',
			'status'        	=> 'status',
			'seo_title'     	=> 'seo_title',
			'seo_image'     	=> 'seo_image',
			'seo_description'	=> 'seo_description',
			'hits'          	=> 'hits',
			'created'       	=> 'created',
			'updated'       	=> 'updated',
			'creator_id'    	=> 'creator_id',
			'editor_id'     	=> 'editor_id',
			'published'     	=> 'published',
			'position'    		=> 'position'
		);
	}
	
	public function initialize(){
		$this->hasMany('id', '\Modules\App\Models\NewsArticleCategoryModel', 'news_id', ['alias' => 'news_to_newscategory']);
	}
	
	private function getController() {
		return "news-article";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}
	
	/*public function sql(){
		return "SELECT NA.id,NA.title,NA.status,NA.hits,NA.created,NA.published,(SELECT username FROM \Modules\Backend\Models\Member AS M WHERE M.id = NA.creator_id) AS creator,NC.title AS category_title
		FROM \Modules\Backend\Models\News_article AS NA JOIN \Modules\Backend\Models\News_category AS NC ON NA.category_id = NC.id";
	}*/

	public function datatable_column(){
		$newsCategoryMenu = NewsCategoryModel::init()->findMenu();
		$init_data = array (
			array (
				'name'		=> 'na@title',
				'label' 	=> 'Tiêu đề',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'na@category_id',
				'label' 	=> 'Danh mục',
				'width'		=> '80px',
				'filter'	=> array(
					"type"  => "select",
					"value" => $newsCategoryMenu
				)
			),		
			array (
				'name'		=> 'na@featured',
				'label' 	=> 'Nổi bật',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),	
			array (
				'name'		=> 'na@status',
				'label' 	=> 'Hiển thị',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name'		=> 'creator',
				'label' 	=> 'Người tạo',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'na@created',
				'label' 	=> 'Ngày tạo',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'na@published',
				'label' 	=> 'Ngày đăng',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			
			array (
				'name' 		=> 'na@id',
				'label'		=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width'		=> '100px'
			)
		);
		return $init_data;
	}

	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['na.title', 'nc.title as category_name', 'na.featured',  'na.status','m.username as creator','na.created', 'na.published', 'na.id'],
			'from' 			=> ['na' => 'Modules\App\Models\NewsArticleModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' 				=> ['alias' => 'm','on' => 'na.creator_id=m.id'],
				'Modules\App\Models\NewsCategoryModel' 	=> ['alias' => 'nc','on' => 'na.category_id=nc.id']
			],
			'group_by' 	=> array('na.id')
		]);

		$result->json_data = array();
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'na@title' 				=> $item->title,
				'na@category_id' 	=> $item->category_name,
				'na@featured'     => $this->changeValue('featured', $item->id, $item->featured, $this->getController()),
				'na@status'     	=> $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator' 				=> $item->creator,	
				'na@created'	 		=> $item->created,
				'na@published' 		=> $item->published,
				'na@id'						=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

	public function statistic($month = 1){
		$sql = "SELECT COUNT(id) as total
						FROM \Modules\App\Models\NewsArticleModel 
						WHERE YEAR(created) = YEAR(CURDATE()) AND MONTH(created) = ".$month." 
						GROUP BY MONTH(created) 
						ORDER BY MONTH(created)
					";

		$query  = new Query($sql, $this->getDI());
		$robots = $query->execute();
		return $robots;
	}

	# region Frontend 

		public function newsDetailWithCode($code){
			$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
			return $queryBuilder
				->columns(['na.title', 'na.code', 'na.image', 'na.description', 'na.content', 'na.published', 'na.hits', 'nc.title as category_title', 'nc.code as category_code'])
				->from(['na' => '\Modules\App\Models\NewsArticleModel'])
				->innerJoin('\Modules\App\Models\NewsCategoryModel', 'nc.id= na.category_id', 'nc')
				->where("na.code = '{$code}'")
				->getQuery()->getSingleResult();
		}

		public function newsWithCategory($category_code = null, $option = null){
			$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();

			$in_category_id = array();

			if($category_code && !empty($category_code)){
				$category_code = is_array($category_code)? $category_code : [$category_code];

				foreach ($category_code as $value) {
					$category = \Modules\App\Models\NewsCategoryModel::findFirst(array(
						'columns'    => 'id',
						'conditions' => 'code = :code: and status = 1',
						'bind'       => array('code'=>$value)
					));
					if(!empty($category)) {

						$Ohi = new \Modules\Library\Oh\Ohi();
						$Ohi->getChildCategoryId('NewsCategoryModel', $category->id, $in_category_id);
						// $this->getDI()->getFactory()->get_child_category_id('News_category', $category->id, $in_category_id);
					}
				}
			} else {
				$list_category = \Modules\App\Models\NewsCategoryModel::find(array(
					'columns'    => 'id',
					'conditions' => 'status = 1'
				));

				foreach ($list_category as $value) {
					$in_category_id[] = $value->id;
				}
			}

			if(count($in_category_id) > 0){
				$in_category_id = array_unique($in_category_id);
				$in_category_id = implode(',', $in_category_id);
				$news_item  = $this->modelsManager->createQuery("SELECT DISTINCT(NAC.news_id) AS news_id FROM Modules\App\Models\NewsArticleCategoryModel AS NAC WHERE category_id IN ($in_category_id)")->execute();
				
				$news_id = array();
				foreach ($news_item as $key => $value) {
					$news_id[] = $value->news_id;
				}
				
				$builder = new \Phalcon\Mvc\Model\Query\Builder();				
				$builder->columns(array('NA.id, NA.title, NA.code, NA.image, NA.description, NA.content, NA.published, NC.title AS category_title, NC.code AS category_code, NC.id AS category_id'))
								->addFrom('Modules\App\Models\NewsArticleModel','NA')
								->leftJoin('Modules\App\Models\NewsCategoryModel', 'NA.category_id = NC.id','NC')
								->inWhere('NA.id', $news_id)
								->andWhere('NA.status = 1');
				
				if(!empty($option['where']) and is_array($option['where'])){
					foreach ($option['where'] as $key => $value) {
						$builder->andWhere("{$key} = :$key:", array("{$key}" => "{$value}"));
					}
				}

				if(!empty($option['limit'])){
					$builder->limit($option['limit']);
				}

				if(!empty($option['offset'])){
					$builder->offset($option['offset']);
				}

				if(!empty($option['order'])){
						$builder->orderBy("NA.{$option['order']} DESC");
				} else {
						$builder->orderBy("NA.published DESC");
				}

				$result = $builder->getQuery()->execute();
				
				return $result;
			}

			return null; 
		}

	/*public static function getNewsByCategory($modelsManager, $category){
		return $modelsManager->createBuilder()
			->addFrom('\Modules\App\Models\NewsArticleModel', 'na')
			->innerJoin('\Modules\App\Models\NewsArticleCategoryModel', 'nac.news_id= na.id', 'nac')
			->innerJoin('\Modules\App\Models\NewsCategoryModel', 'nac.category_id= nc.id', 'nc')
			->where('nc.code = "'.$category.'"')
			->orderBy('na.published')
			->getQuery()
			->execute();
	}

	public function search($category, $keyword, $limit = 6, &$pagination = null){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		$category = is_array($category)? $category : [$category];
		$queryBuilder = $queryBuilder
			->from(['na' => '\Modules\App\Models\NewsArticleModel'])			
			->innerJoin('\Modules\App\Models\NewsArticleCategoryModel', 'nac.news_id= na.id', 'nac')
			->innerJoin('\Modules\App\Models\NewsCategoryModel', 'nac.category_id= nc.id', 'nc')
			->where('(na.title LIKE :keyword: OR nc.title LIKE :keyword: OR na.description LIKE :keyword: OR na.content LIKE :keyword:) AND nc.code IN ("'.implode('","', $category).'")', ['keyword' => "%{$keyword}%"]);
				
		$offset = 0;
		if($pagination && $limit > 0){
			$page = 1;
			if(isset($pagination['page']) && $pagination['page'] > 1){
				$page = (int)$pagination['page'];
			}
			$dataCount = $queryBuilder
				->columns(['count(*) as news_count'])
				->getQuery()
				->getSingleResult();

			$page_total = 1;
			if($dataCount && !empty($dataCount)){
				$total = $dataCount->news_count;
				$page_total = $total/$limit;
				$page_total = $page_total>intval($page_total)? intval($page_total) + 1: $page_total;
			}

			$offset = ($page - 1)*$limit;
			$pagination = [
				'page' 		=> $page,
				'page_total'=> $page_total
			];
		}
		$data =	$queryBuilder
			->columns(['na.title', 'na.code', 'na.description', 'na.published', 'na.image', 'na.link', 'nc.title as category_title', 'nc.code as category_code'])
			->limit($limit, $offset)
			->orderBy('na.updated desc')
			->getQuery()
			->execute();
		return $data;
	}	

	public function newsWithCategory($category, $limit = 6, &$pagination = null){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		$category = is_array($category)? $category : [$category];
		$queryBuilder = $queryBuilder
			->from(['na' => '\Modules\App\Models\NewsArticleModel'])			
			->innerJoin('\Modules\App\Models\NewsArticleCategoryModel', 'nac.news_id= na.id', 'nac')
			->innerJoin('\Modules\App\Models\NewsCategoryModel', 'nac.category_id= nc.id', 'nc')
			->where('nc.code IN ("'.implode('","', $category).'")');
				
		$offset = 0;
		if($pagination && $limit > 0){
			$page = 1;
			if(isset($pagination['page']) && $pagination['page'] > 1){
				$page = (int)$pagination['page'];
			}
			$dataCount = $queryBuilder
				->columns(['count(*) as news_count'])
				->getQuery()
				->getSingleResult();

			$page_total = 1;
			if($dataCount && !empty($dataCount)){
				$total = $dataCount->news_count;
				$page_total = $total/$limit;
				$page_total = $page_total>intval($page_total)? intval($page_total) + 1: $page_total;
			}

			$offset = ($page - 1)*$limit;
			$pagination = [
				'page' 		=> $page,
				'page_total'=> $page_total
			];
		}

		$data =	$queryBuilder
			->columns(['na.title', 'na.code', 'na.description', 'na.published', 'na.image', 'na.link', 'nc.title as category_title', 'nc.code as category_code'])
			->limit($limit, $offset)
			->orderBy('na.updated desc')
			->getQuery()
			->execute();
		return $data;
	}

	public function newsWithCategoryChildren($category_code, $limit = 5, &$pagination = null){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		if($category_code && !empty($category_code)){
			$category_code = is_array($category_code)? $category_code : [$category_code];
		}
		
		$queryBuilder
			->from(['nc' => '\Modules\App\Models\NewsCategoryModel'])
			->columns(['nc.id', 'nc.title', 'nc.code']);
		
		if($category_code && !empty($category_code)){
			$queryBuilder
				->innerJoin('\Modules\App\Models\NewsCategoryModel', 'ncc.id=nc.parents', 'ncc')
				->where('ncc.code IN ("'.implode('","', $category_code).'")');
		}

		$categoryModel = $queryBuilder->getQuery()->execute();

		$category_children = $category_code;
		foreach($categoryModel as $item){
			$category_children[] = $item->code;
		}
		
		return $this->newsWithCategory($category_children, $limit, $pagination);
	}*/
}