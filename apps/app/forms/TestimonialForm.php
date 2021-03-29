<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class TestimonialForm extends Form {
	
	public function initialize($model = null) {
	
		$name = new Text("name");
		$name->addValidator(new PresenceOf());
		$this->add($name);

		$this->add(new Text("info"));
		$this->add(new Text("avatar"));
		$this->add(new TextArea("description", ['rows'=>6]));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));
		$this->add(new Numeric("position"));
	}
}
