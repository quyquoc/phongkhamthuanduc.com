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
use Modules\App\Models\GuestReviewModel;

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
		$list_review		= GuestReviewModel::find(array(
			"conditions"	=> "status = 1",
			"order"				=> "position ASC, created DESC"
		));

		$this->view->list_review = $list_review;		
		$this->view->partial("elements/BoxGuestReview");		
	}

	public function BoxContact($title = null) {
		$this->view->title = $title;
		$this->view->partial("elements/BoxContact");		
	}

	public function BoxStaff() {

		$this->view->list_staff_1 = StaffModel::find(array(
			"conditions"	=> "status = 1 AND type_id = 1",
			"order"				=> "position ASC"
		));
		$this->view->list_staff_2 = StaffModel::find(array(
			"conditions"	=> "status = 1 AND type_id = 2",
			"order"				=> "position ASC"
		));
		$this->view->list_staff_3 = StaffModel::find(array(
			"conditions"	=> "status = 1 AND type_id = 3",
			"order"				=> "position ASC"
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
			$list_item = NewsArticleModel::init()->newsWithCategory($category_code, $options);
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

	/*
	** Shop
	*/
	public function Cart() {

		// $this->cart->getContent();
		// $this->cart->getTotalItems();

		$cart = new \Modules\Library\Oh\ShoppingCart("myShop");
		$this->view->plugin_cart = $cart->getContent();
		$this->view->cart_total_items = !empty($cart->getContent()) && count($cart->getContent()) > 0 ? count($cart->getContent()) : 0;
	}

	public function ShopBoxProduct($category_code = null, $options = null){

		$conditions = "status = 1";
		$order 			= "published DESC";
		$limit 			= !empty($options['limit']) ? $options['limit'] : 8;

		if (!empty($options['type'])) {
			switch ($options['type']) {
				case 'featured':
					$this->view->title = "Sản phẩm nổi bật";
					$conditions .= " AND featured = 1";
					break;
				case 'saleoff':
					$this->view->title = "Sản phẩm giảm giá";
					$conditions .= " AND saleoff != 0 AND saleoff < price";
					break;
				case 'latest':
					$this->view->title = "Sản phẩm mới";
					break;
				default:
					$this->view->title = "Sản phẩm";
					break;
			}
		}

		$list_item = ShopProductModel::find(array(
			"conditions"	=> $conditions,
			"order"				=> $order,
			"limit" 			=> $limit
		));

		$this->view->list_item = $list_item;
		$this->view->type = $options['type'];
		$this->view->partial("elements/ShopBoxProduct");		
	}

	public function ShopListProductItem($list_item = null, $options = null) {

		if(!empty($list_item)){
			$this->view->list_item 	= $list_item;
			$this->view->options 		= $options;
			$this->view->partial("elements/ShopListProductItem");
		}
	}

	public function ShopBoxTabCategory(){
		
		$arr_category_code 	= array('bao-cao-su-cao-cap', 'gel-boi-tron', 'tri-xuat-tinh-som', 'sextoys');

		foreach ($arr_category_code as $key => $value) {
			$conditions 	= "code = :code: AND status = 1";
			$category		= ShopCategoryModel::findFirst(array(
				"conditions" 	=> $conditions, 
				"bind"			=> array('code'=>$value),
			));

			$in_category_id 	= '';
			$this->factory->get_child_category_id('Shop_category', $category->id, $in_category_id);
			$in_category_id = implode(',', $in_category_id);
			$conditions 		= "category_id IN ({$in_category_id}) AND status = 1";
			$products 			= ShopProductModel::find(array(
				'conditions' => $conditions,
				'order'		=> 'published DESC',
				"limit"		=>	12,
			));
			$list_products[] = $products;
		}
		$this->view->list_products 			= $list_products;
		$this->view->arr_category_code 	= $arr_category_code;
		$this->view->partial("elements/ShopBoxTabCategory");		
	}

	public function ShopMenuCategoryWithParents($parents = 0) {

		$list_menu = ShopCategoryModel::find(array(
			"conditions" 	=> "parents = {$parents} AND status = 1",
			"order"				=> "position ASC"
		));
		$this->view->list_menu = $list_menu;
		$this->view->partial("elements/ShopMenuCategory");
	}

	public function ShopBoxCategory() {
		$arr_category = array();

		$list_category = ShopCategoryModel::find(array(
			"conditions" 	=> "parents = 0 AND status = 1",
			"order"				=> "position ASC"
		));
		if (!empty($list_category)) {
			foreach ($list_category as $key => $value) {

				$arr_category[$key]['title'] 	= $value->title;
				$arr_category[$key]['code'] 	= $value->code;

				$list_sub_category = ShopCategoryModel::find(array(
					"conditions" 	=> "parents = {$value->id} AND status = 1",
					"order"				=> "position ASC"
				));
				$arr_category[$key]['sub_category'] = $list_sub_category;
			}
		}

		$this->view->list_menu = $arr_category;
		$this->view->partial("elements/ShopBoxCategory");
	}
}	

/* End of file Element.php */
/* Location: ./apps/frontend/elements/Element.php */