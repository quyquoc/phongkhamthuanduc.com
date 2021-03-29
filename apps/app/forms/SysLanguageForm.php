<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\Select,
Phalcon\Validation\Validator\PresenceOf;

class SysLanguageForm extends Form {

	public function initialize(){	

		$code = new Text("code");
		$code->addValidator(new PresenceOf());
		$this->add($code);
		
		$this->add(new Text("description"));
		$this->add(new Select('default',array('0'=>'Không','1'=>'Mặc định')));
	}	
}
