<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\Email,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Password,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class MemberForm extends Form {

	public function initialize(){	

    $username = new Text("username");
    $username->setFilters(array('striptags', 'string'));
		$username->addValidators(array(new PresenceOf()));
		$this->add($username);

  	$password = new Password('password');
    $this->add($password);

    $this->add(new Text("fullname"));
    $this->add(new Text("image"));
    $this->add(new Text("email"));
		$this->add(new Select('gender',array('0'=>$this->language->_('famale'),'1'=>$this->language->_('male'))));
		$this->add(new Text("birthday"));
		$this->add(new Text("address"));
		$this->add(new Text("phone"));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));
		$this->add(new Select('group_id',\Modules\App\Models\PermissionGroupModel::find(array("conditions"=>"name != 'Founder'")), array('using' => array('id', 'name'),'class'=>'medium')));
	}
}
