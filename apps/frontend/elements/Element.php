<?php
namespace Modules\Frontend\Elements;
use Phalcon\Mvc\User\Component;
use Modules\App\Models\NewsArticleModel;
use Modules\App\Models\NewsCategoryModel;
use Modules\App\Models\NewsArticleCategoryModel;
use Modules\App\Models\ImageModel;
use Modules\App\Models\ImageAlbumModel;
use Modules\App\Models\ShopCategoryModel;
use Modules\App\Models\ShopProductModel;
use Modules\App\Models\TestimonialModel;
use Modules\App\Models\StaffModel;
use Modules\App\Models\ServiceModel;
use Modules\App\Models\DepartmentModel;

class Element extends Component{

	/*
	** General
	*/
	public function getConfig($code){

		$config = new \Modules\Frontend\Models\Config;
		$list = $config::findFirstByCode($code);
		
		return isset($list->data) ? $list->data : '';
	}

	public function script($params = null) {

		if(!empty($params)){
			foreach ($params as $key => $value) {
				if ($value == 'slick') {
					$this->assets->addCss('/library/slick/slick/slick.css');
					$this->assets->addJs('/library/slick/slick/slick.js');
				}
				if ($value == 'animate') {
					$this->assets->addJs('/library/animate/animate.min.js');
					$this->assets->addJs('/library/animate/animate.css');
				}
			}
		}
	}

	public function Menu($menu_id, $parent, $level){
		$menu_item = new \Modules\Frontend\Models\Menu_item;
		$conditions = "menu_id = :id: AND status = 1 AND parents = :parents:";
		$menu_item = $menu_item::find(array(
			"conditions"	=>	$conditions,
			"bind"			=>	array("id"=>$menu_id, 'parents'=>$parent),
			"order"			=>	"position asc"
		));
		
	  	if($level > 0 && count($menu_item) > 0){
	    	echo '<ul id="menu-1" class="menunav">';
	  	}
		foreach ($menu_item as $key => $value) {

			$active = '';
			if(isset($value->link) && !empty($value->link)){
				$active = strpos($_SERVER['REQUEST_URI'], $value->link) != 0 ? ' active' : '';
			}else{

				$active = count($this->request->get())<1 ? ' active' : '';
			}

			echo '<li class="li_'.$value->id.' '.$active.'">';
			
		    echo '<a href="'.$this->url->get('/').$value->link.'">' . $value->title . '</a>';
		    
		    $this->menu($menu_id,$value->id, $level+1);
		    
		    echo "</li>";
		}
		if($level > 0 &&  count($menu_item) > 0){
			echo '</ul>';
		}
	}

	/*
	** Boxes
	*/
	public function BoxSlide($type = null){

		if ($type == 'album'){
			$slide					= ImageModel::findFirst(array(
				"conditions" 	=> "album_id = 1 AND status = 1", 
				"order"				=> "position ASC, created DESC"
			));	
		}else{
			$slide					= ImageModel::find(array(
				"conditions" 	=> "album_id = 1 AND status = 1", 
				"order"				=> "position ASC, created DESC",
				"limit" 		=> 12
			));	
		}
		$this->view->setVar('slide', $slide);
		$this->view->setVar('type', $type);
		$this->view->partial("elements/BoxSlide");
	}

	public function BoxSlideDAThumbs($type = null){

		$this->assets->addCss('/library/DirectionAwareHoverEffect/css/style.css');
		$this->assets->addJs('/library/DirectionAwareHoverEffect/js/jquery.hoverdir.js')
								 ->addJs('/library/DirectionAwareHoverEffect/js/modernizr.custom.97074.js');

		if(!empty($type) && $type == 'album') {
			$gallery 	= ImageModel::findFirst(array(
				"conditions"	=> "album_id = 2 AND status = 1"
			));
		} else {
			$gallery 	= ImageModel::find(array(
				"conditions"	=> "album_id = 2 AND status = 1",
				"order"			=> "position ASC, created DESC",
				"limit" 		=> 12
			));
		}
		$this->view->gallery 	= $gallery;
		$this->view->type 		= $type;
		$this->view->partial("elements/BoxSlideDAThumbs");
	}

	public function BoxPartner() {

		$album		= ImageAlbumModel::findFirstByCode('partner');
		if(!empty($album)) {
			$list_partner		= ImageModel::find(array(
				"conditions"	=> "album_id = {$album->id} AND status = 1",
				"order"				=> "position ASC, created DESC"
			));

			$this->view->list_partner = $list_partner;		
			$this->view->partial("elements/BoxPartner");
		}
	}

	public function BoxGuestReview() {
		$list_review		= TestimonialModel::find(array(
			"conditions"	=> "status = 1",
			"order"				=> "position ASC, created DESC"
		));

		$this->view->list_review = $list_review;		
		$this->view->partial("elements/BoxGuestReview");		
	}

	public function BoxContact($title = null) {
		$this->view->title = $title;
		$this->view->list_option= DepartmentModel::find(array(
			"conditions"	=> "status = 1",
			"order"			=> "position ASC"
		));
		$this->view->partial("elements/BoxContact");		
	}
	public function PopupContact() {
		$this->view->list_options= ServiceModel::find(array(
			"conditions"	=> "status = 1",
			"order"			=> "position ASC"
		));
		$this->view->partial("elements/PopupContact");		
	}

	public function BoxStaff() {

		
		$this->view->list_staff= StaffModel::find(array(
			"conditions"	=> "status = 1 and manager = 1",
			"order"			=> "position ASC"
		));

		$this->view->partial("elements/BoxStaff");	
	}

	public function BoxTestimonial() {

		$this->view->list_testimonial = TestimonialModel::find(array(
			"conditions"	=> "status = 1",
			"order"				=> "position ASC"
		));

		$this->view->partial("elements/BoxTestimonial");	
	}

	/*
	** News
	*/
	public function NewsBoxArticle($category_code = null, $options = null){

		$conditions = "status = 1";
		$order 			= "published DESC";

		if (!empty($options['type'])) {
			
			$this->view->type = $options['type'];
			
			switch ($options['type']) {
				case 'featured':
					$this->view->title = "Tin nổi bật";
					$conditions .= " AND featured = 1";
					break;
				case 'latest':
					$this->view->title = "Tin mới nhất";
					break;
				default:
					$this->view->title = $category_code;
					break;
			}
		}

		if(!empty($category_code) && !is_array($category_code)){

			$category = NewsCategoryModel::findFirst(array(
				'conditions'	=> 'code = :code: and status = 1',
				'bind'				=> array('code'=>$category_code)
			));
			$this->view->category = $category;
			$this->view->category_code = $category->code;

			if(!empty($category)){
				$list_item = NewsArticleModel::init()->newsWithCategory($category->code, $options);
			}
		}else {
			$this->view->title = "Tin mới nhất";
			$category_code = NewsCategoryModel::findFirst(array(
				'conditions'	=> 'code = :code: and status = 1',
				'bind'				=> array('code'=>'gioi-thieu')
			));
			$list_item = NewsArticleModel::find(array(
				"conditions" =>"status = 1 and category_id != $category_code->id",
				"order"		 => "published DESC , created DESC",
				"limit"		=> 6
			));
			// $list_item = NewsArticleModel::init()->newsWithCategory($category_code, $options, $limit = 6);
		}

		$this->view->list_article = $list_item;
		$this->view->partial("elements/NewsBoxArticle");		
	}
	
	public function NewsMenuWithCategory($category_code = null, $options = null) {

		if($category_code) {
			$category = NewsCategoryModel::findFirst(array(
				'conditions'	=> 'code = :code: and status = 1',
				'bind'				=> array('code'=>$category_code)
			));
			$this->view->category = $category;

			if(!empty($category)) {
				$list_menu = NewsCategoryModel::find(array(
					"conditions" 	=> "parents = {$category->id} AND status = 1",
					"order"				=> "position ASC"
				));

				if (!empty($list_menu) && count($list_menu) > 0) {
					$level 		= !empty($options['level']) ? $options['level'] : 1;
					$menu_lv  = $this->view->menu_lv.$level;
					
					echo '<ul class="level'.$level.'">';
					
					foreach ($list_menu as $item) {
			      echo '<li class="'.($this->view->menu_lv1==$item->code ? ' active' : '').'"><a href="'. $this->url->get('/'. $item->code) .'"><i class="fa fa-angle-right" aria-hidden="true"></i>'. $item->title .'</a>';

						$this->NewsMenuWithCategory($item->code, ['level'=>$level + 1]);

						echo '</li>';
					}
				  echo '</ul>';
				}
			}
		}
	}

	public function NewsMenuArticleWithCategory($category_code = null, $options = null) {

		if($category_code) {
			$category = NewsCategoryModel::findFirst(array(
				'conditions'	=> 'code = :code: and status = 1',
				'bind'				=> array('code'=>$category_code)
			));
			$this->view->category = $category;

			if(!empty($category)) {
				$list_menu = NewsArticleModel::find(array(
					"conditions" 	=> "category_id = {$category->id} AND status = 1",
					"order"				=> "position ASC"
				));
				$this->view->list_menu = $list_menu;
				$this->view->partial("elements/NewsMenuArticleWithCategory");
			}
		}
	}
	public function LevelMenu( $option = null) {
		if($option =='dich-vu') {
			$service = ServiceModel::find(array(
				"conditions"	=> "status = 1 and code != 'kham-bao-hiem-y-te'",
				"order"			=> "id ASC"
			));
			$list_menu = $service;
		}
		elseif($option =='gioi-thieu') {
			$category = NewsCategoryModel::findFirstByCode($option);
			$artical = NewsArticleModel::find(array(
				"conditions"	=> "status = 1 and category_id = $category->id",
				"order"			=> "id ASC"
			));
			$list_menu = $artical;
		}
		else{
			$depart = DepartmentModel::find(array(
				"conditions"	=> "status = 1",
				"order"			=> "id ASC"
			));
			$list_menu = $depart;
		}
		
	
		$this->view->option = $option ;
		$this->view->list_menu = $list_menu ;
		$this->view->partial("elements/LevelMenu");		
	}
}	

/* End of file Element.php */
/* Location: ./apps/frontend/elements/Element.php */