<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class NewsCategoryForm extends Form {

	public function initialize($model = null){
	
		$title = new Text("title");
		$title->addValidator(new PresenceOf());
		$this->add($title);

		$this->add(new Text("code"));
		$this->add(new Text("image"));
		$this->add(new TextArea("description"));
		$this->add(new Numeric("position"));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));

		$recursive = \Modules\App\Models\NewsCategoryModel::init()->findMenu();
		$parents= new Select('parents', $recursive);
		$this->add($parents);
	}
}
