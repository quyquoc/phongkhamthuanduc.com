<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class StaffForm extends Form {

	public function initialize($model = null){	

    $fullname = new Text("fullname");
		$fullname->addValidator(new PresenceOf());
		$this->add($fullname);
		
		$this->add(new Text("code"));
		$this->add(new Text("image"));
		$this->add(new Text("staff_position"));
		$this->add(new Text("phone"));
		$this->add(new Text("subject"));
		$this->add(new Text("email"));
		$this->add(new Text("facebook"));
		$this->add(new TextArea("education"));
		$this->add(new TextArea("experience"));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));

		$type_id = new Select('type_id', \Modules\App\Models\StaffTypeModel::find(),array('using' => array('id', 'name')));
		$this->add($type_id);

		// $this->add(new Select("staff_type_id",array('1'=>$this->language->_('Founder'), '2'=>$this->language->_('Staff'))));
		$this->add(new Numeric("position"));
	}
}

