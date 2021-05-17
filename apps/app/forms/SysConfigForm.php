<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class SysConfigForm extends Form {

	public function initialize($model = null) {	

		$title = new Text("title");
		$title->addValidator(new PresenceOf());
		$this->add($title);

		$code = new Text("code");
		$code->addValidator(new PresenceOf());
		$this->add($code);
		$this->add(new TextArea("data"));
		$this->add(new Text("description"));
		$this->add(new Text("image"));
		$this->add(new Text("link"));
		$this->add(new Select('url_target', array('_self'=>$this->language->_('normal'),'_blank'=>$this->language->_('_blank'))));
		$this->add(new Select("status",array('0'=>$this->language->_('Không'), '1'=>$this->language->_('Có'), array("value" =>'1'))));
	}	
}