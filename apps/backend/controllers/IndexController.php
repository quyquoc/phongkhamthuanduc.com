<?php
namespace Modules\Backend\Controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class IndexController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}

	public function indexAction() {

		$this->view->title = 'Hệ thống';

		$this->assets->addJs('/library/flot/jquery.flot.min.js')
								 ->addJs('/library/flot/jquery.flot.resize.min.js')
								 ->addJs('/library/flot/jquery.flot.pie.min.js')
								 ->addJs('/library/flot/jquery.flot.categories.min.js');

		$tbl_news_category	= new \Modules\App\Models\NewsCategoryModel();
		$tbl_article 				= new \Modules\App\Models\NewsArticleModel();
		$tbl_member 				= new \Modules\App\Models\MemberModel();
		$tbl_image 					= new \Modules\App\Models\ImageModel();

		$this->view->num_article	= $tbl_article->count();
		$this->view->num_image		= $tbl_image->count();
		$this->view->num_category	= $tbl_news_category->count();

		$this->view->num_member 	= $tbl_member->count(array(
			"conditions" => "username != 'admin' AND username != 'founder'",
		));
		
		$this->view->latest_article	= $tbl_article->find(array(
			"order"		=> "created DESC",
			"limit"		=> 10,
		));

		// line chart
		for($i = 1; $i<=12; $i++){
			$count = ($tbl_article->statistic($i) && count($tbl_article->statistic($i))>0) ? $tbl_article->statistic($i)[0]->total : 0;
			$line_chart[] = array('T'.$i, $count);
		}
		$this->view->line_chart = json_encode($line_chart);
	}
}

