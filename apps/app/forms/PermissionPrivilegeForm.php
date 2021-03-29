<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Validation\Validator\PresenceOf;

class PermissionPrivilegeForm extends Form {

	public function initialize(){	
		
		$name = new Text("name");
		$name->addValidator(new PresenceOf(array(
				'message' => 'name'
		)));
    $this->add($name);

    $controller = new Text("controller");
		$controller->addValidator(new PresenceOf(array(
			'message' => 'controller'
		)));
    $this->add($controller);

    $action = new Text("action");
		$action->addValidator(new PresenceOf(array(
			'message' => 'action'
		)));
    $this->add($action);

    $this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes'))));
    
    $position = new Text("position");
    $this->add($position);
	}
}
