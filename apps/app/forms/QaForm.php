<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class QaForm extends Form {
	
	public function initialize($model = null){
	
		// Main tab
		$this->add(new Text("fullname"));    
		$this->add(new Text("phone"));      
		$this->add(new Text("email"));  
		$this->add(new Text("code"));  
		$question = new Text("question");
		
		$question->addValidator(new PresenceOf());
		$this->add($question);

		$this->add(new TextArea("answer"));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));

	}
}