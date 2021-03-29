<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\Numeric,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Validation\Validator\PresenceOf;

class PermissionGroupForm extends Form {

	public function initialize(){	
		
		$name = new Text("name");
		$name->addValidator(new PresenceOf(array(
			'message' => 'name'
		)));
    $this->add($name);
    
    $this->add(new Select("permission",array("full"=>"Full","limit"=>"Limit")));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes'))));
	}
}
