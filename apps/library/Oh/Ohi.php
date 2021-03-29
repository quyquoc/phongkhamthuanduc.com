<?php
namespace Modules\Library\Oh;
use Modules\App\Models\NewsArticleModel;
use Modules\App\Models\NewsCategoryModel;
use Modules\App\Models\RecruitmentWorkModel;
use Modules\App\Models\SectorModel;
use Modules\App\Models\SysConfigModel;

class Ohi{
	
	public function baseUrl(){
		return ROOT_URL;
	}

	public function baseAdminUrl($path = ""){
		if($path && !empty($path)){
			$path = '/'.preg_replace('@^/+@', '', $path);
		}
		return ROOT_URL. "/admin".$path;
	}

	public function FrotendHomePath($dir = ""){
		return ROOT_URL."/frontend/home/{$dir}";
	}

	public function homeImagePath($file = ""){
		return ROOT_URL."/frontend/home/images/{$file}";
	}

	public function LibPath($lib_name, $type = 'css' ){
		$path = "/library/";
		switch($lib_name){
			case "slick":
				$path .= "slick/slick/";
				if($type == 'css'){
					$path .= "slick.css";
				} elseif($type == 'js') {
					$path .= "slick.min.js";
				}
			break;
		}
		return $path;
	}

	public function link($href, $nav, $params = null){
		$url = '#';
		switch($nav){
			case "gioi-thieu":
				if($href && !empty($href)){
					$url = $href;
				} else {
					$url = ROOT_URL."/gioi-thieu";
					if($params && !empty($params)){
						$url .= "/".$params;
					}
				}					
			break;
			default:
				if($href && !empty($href)){
					$url = $href;
				} else {
					$url = ROOT_URL."/{$nav}";
					if($params && !empty($params)){
						$url .= "/".$params;
					}
				}					
			break;
		}
		return $url;
	}

	/** 
	 *  Lấy toàn bộ childCategoryID con từ 1 id cha arrCategory
	 *  @param $name_table [string]
	 *  @param $parents [integer]
	 *  @param $data [object]
	 */
	public function getChildCategoryId($name_table = null, $parents = null, &$data = null){
		
		$table      = "\Modules\App\Models\\".$name_table;
		$result     = $table::find(array(
			"conditions"    => "parents = :parents: AND status = 1",
			"bind"          => array('parents'=>$parents),
			"columns"       => "id"
		));
		
		if(count($result) > 0){
			foreach ($result as $key => $value) {
				$data[] = $value->id;
				$this->getChildCategoryId($name_table, $value->id, $data);
			}   
		}
		$data[] = $parents; 
	}


	public function activeMenuClass($segment, $currentSegment){
		return strtolower($segment) == strtolower($currentSegment)?'active':'';
	}

	# region News 

		public function newsWithMutilCategory($category){
			$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
			$queryBuilder = $queryBuilder
				->from(['na' => '\Modules\App\Models\NewsArticleModel'])
				->columns(['na.title', 'na.code', 'na.description', 'na.published', 'na.image', 'nc.title as category_title', 'nc.code as category_code'])
				->innerJoin('\Modules\App\Models\NewsArticleCategoryModel', 'nac.news_id= na.id', 'nac')
				->innerJoin('\Modules\App\Models\NewsCategoryModel', 'nac.category_id= nc.id', 'nc');
			$category = is_array($category)? $category : [$category];
			foreach($category as $cat_item){
				$queryBuilder->orWhere('nc.code = "'.$cat_item.'"');
			}
			$data = $queryBuilder->orderBy('na.updated')
					->getQuery()->execute();

			return $data;
		}

		/*public function newsWithCategory($category, $limit = 6){
			$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
			$queryBuilder = $queryBuilder
				->from(['na' => '\Modules\App\Models\NewsArticleModel'])
				->columns(['na.title', 'na.code', 'na.description', 'na.published', 'na.image', 'nc.title as category_title', 'na.link', 'nc.code as category_code'])
				->join('\Modules\App\Models\NewsArticleCategoryModel', 'nac.news_id= na.id', 'nac')
				->join('\Modules\App\Models\NewsCategoryModel', 'nac.category_id= nc.id', 'nc')
				->limit($limit);
			$category = is_array($category)? $category : [$category];
			$data = $queryBuilder
					->orWhere('nc.code IN ("'.implode('","', $category).'")')
					->orderBy('na.updated desc')
					->getQuery()->execute();

			return $data;
		}

		public function newsWithCategoryChildren($category, $limit = 5){
			$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
			if($category && !empty($category)){
				$category = is_array($category) ? $category : [$category];
			}
			
			$queryBuilder
				->from(['nc' => '\Modules\App\Models\NewsCategoryModel'])
				->columns(['nc.id', 'nc.title', 'nc.code']);
			if($category && !empty($category)){
				$queryBuilder
					->join('\Modules\App\Models\NewsCategoryModel', 'ncc.id=nc.parents', 'ncc', 'LEFT')
					->where('ncc.code IN ("'.implode('","', $category).'")');
			}
				
			$categoryModel = $queryBuilder->getQuery()->execute();		
			
			$category_children = $category;
			foreach($categoryModel as $item){
				$category_children[] = $item->code;
			}
			return $this->newsWithCategory($category_children, $limit);
		}

		public function newsDetail($category, $code){
			$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
			$data = $queryBuilder
				->from(['na' => '\Modules\App\Models\NewsArticleModel'])
				->columns(['na.title', 'na.code', 'na.description', 'na.content', 'na.published', 'na.image', 'nc.title as category_title', 'nc.code as category_code'])
				->innerJoin('\Modules\App\Models\NewsArticleCategoryModel', 'nac.news_id= na.id', 'nac')
				->innerJoin('\Modules\App\Models\NewsCategoryModel', 'nac.category_id= nc.id', 'nc')
				->where('nc.code = :category: AND na.code = :news_code:', ['category' => $category, 'news_code' => $code])
				->orderBy('na.updated desc')
				->getQuery();
			return $data->getSingleResult();
		}*/
	# endregion News

	public function projectDetailWithCode($code){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		return $queryBuilder
			->from(['na' => '\Modules\App\Models\ProjectModel'])
			->columns(['na.title', 'na.code', 'na.description', 'na.content', 'na.published', 'na.image'])
			->where("na.code = '{$code}'")
			->getQuery()->getSingleResult();
	}
	public function staffDetailWithCode($code){
		
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		return $queryBuilder
			->from(['ns' => '\Modules\App\Models\StaffModel'])
			->columns(['ns.name', 'ns.code', 'ns.image', 'ns.staff_position', 'ns.education', 'ns.experience'])
			->where("ns.code = '{$code}'")
			->getQuery()->getSingleResult();
	}

	public function Recruitments($limit = 5){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		$data = $queryBuilder
			->from(['nw' => '\Modules\App\Models\RecruitmentWorkModel'])
			->columns(['nw.title', 'nw.code', 'nw.description', 'nw.image', 'nw.published', 'nw.finished', 'r.fullname as career_name'])
			->InnerJoin('\Modules\App\Models\RecruitmentModel', 'r.id= nw.career_id', 'r')
			->where('nw.status = :status:', ['status' => 1])
			->orderBy('nw.published')
			->limit($limit)
			->getQuery()->execute();

		return $data;
	}
	public function RecruitmentWithCareer($career_code, $limit = 5){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		$data = $queryBuilder
			->from(['nw' => '\Modules\App\Models\RecruitmentWorkModel'])
			->join('\Modules\App\Models\RecruitmentModel', 'r.id= nw.career_id', 'r')
			->where('nw.status = :status: AND r.phone=:career_code:', ['status' => 1, 'career_code' => $career_code])
			->orderBy('nw.published')
			->limit($limit)
			->getQuery()->execute();

		return $data;
	}
	public function RecruitmentWithCode($code){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		$data = $queryBuilder
			->from(['rw' => '\Modules\App\Models\RecruitmentWorkModel'])
			->where('rw.status = :status: AND rw.code = :code:', ['status' => 1, 'code' => $code])
			->orderBy('rw.published')
			->getQuery()->getSingleResult();

		return $data;
	}

	public function sectorList(){
		return SectorModel::init()->list();
	}

	public function sysConfig($code, $removeHtml = true, $field = 'data'){
		$data = SysConfigModel::init()->findByCode($code, $field);
		if($data && !empty($data)){
			if($removeHtml){
				$data = strip_tags($data);
			}
			return $data;
		}
		return "";
	}
}