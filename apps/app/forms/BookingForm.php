<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class BookingForm extends Form {
	
	public function initialize($model = null){
		$this->add(new Text("fullname"));
		$this->add(new Text("phone"));
		$this->add(new Text("email"));
		$this->add(new Text("adults"));
		$this->add(new Text("children"));
		$this->add(new Text("department_title"));
		$this->add(new TextArea("content"));
		$this->add(new Text("from_date", array('value'=>date('Y-m-d H:i:s'))));
		$this->add(new Text("from_time"));
		$this->add(new Text("created", array('value'=>date('Y-m-d H:i:s'))));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));
	}
}
