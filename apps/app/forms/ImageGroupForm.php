<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class ImageGroupForm extends Form {

	public function initialize(){	
		
		$title = new Text("title");
		$title->addValidator(new PresenceOf());
		$this->add($title);

		$this->add(new Text("code"));
		$this->add(new Text("image"));
		$this->add(new Text("content"));
		$this->add(new Select("featured", array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes'))));
		$this->add(new Select("status", array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));
		$this->add(new Text("position"));
	}	
}
