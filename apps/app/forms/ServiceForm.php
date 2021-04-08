<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class ServiceForm extends Form {

	public function initialize($model = null){
	
		// Main tab
		$title = new Text("title");
		$title->addValidator(new PresenceOf());
		$this->add($title);
		
		$this->add(new Text("image"));
		$this->add(new TextArea("description"));
		$this->add(new Numeric("price"));
		$this->add(new TextArea("content"));
		
		$category_id = new Select('category_id', \Modules\App\Models\ServiceCategoryModel::find(),array('using' => array('id', 'title')));
		$this->add($category_id);

		// Config tab
		$this->add(new Text("code"));
		$this->add(new Text("link"));
		$this->add(new Select('url_target', array('normal'=>$this->language->_('normal'),'_blank'=>$this->language->_('_blank'))));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));
		$this->add(new Select('featured', array('0'=>$this->language->_('Không'), '1'=>$this->language->_('Có'))));
		$this->add(new Text("published", array('value'=>date('Y-m-d H:i:s'))));
		$this->add(new Numeric("position"));

		// SEO tab
		$this->add(new Text("seo_title"));
		$this->add(new Text("seo_image"));
		$this->add(new TextArea("seo_description"));
	}

	public function getValueDefault($id){
		$news_category = \Modules\App\Models\NewsArticleCategoryModel::init()->findByNews_id($id);
		$result = array();
		if(count($news_category) > 0){
			foreach ($news_category as $key => $value) {
				$result[] 	=	$value->category_id;
			}
		}
		return $result;
	}
}
