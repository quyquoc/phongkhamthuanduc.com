<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class NewsArticleCategoryModel extends DatatableManagerModel{
	public function getSource() {
		return "news_article_category";
	}

	public function initialize(){
		$this->belongsTo('news_id', '\Modules\App\Models\NewsArticleModel', 'id', ['alias' => 'news_article']);
		$this->belongsTo('category_id', '\Modules\App\Models\NewsCategoryModel', 'id', ['alias' => 'news_category']);
	}
}