<?php
namespace Modules\App\Forms;
use Phalcon\Forms\Form,
Phalcon\Forms\Element\Text,
Phalcon\Forms\Element\TextArea,
Phalcon\Forms\Element\Select,
Phalcon\Forms\Element\Hidden,
Phalcon\Forms\Element\Numeric,
Phalcon\Validation\Validator\PresenceOf;

class ImageForm extends Form {

	public function initialize(){	
		
		$title = new Text("title");
		$title->addValidator(new PresenceOf());
		$this->add($title);

		$this->add(new Text("code"));
		$this->add(new Text("image"));
		$this->add(new Hidden("imgs"));
		$this->add(new TextArea("content"));
		$this->add(new Select('featured', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes'))));  
		$this->add(new Text("hits"));      
		$this->add(new Text("link"));
		$this->add(new Select('url_target', array('_self'=>$this->language->_('normal'),'_blank'=>$this->language->_('_blank'))));
		$this->add(new Select('status', array('0'=>$this->language->_('no'), '1'=>$this->language->_('yes')), array("value" =>'1')));
		$this->add(new Text("position"));

		$album_id = new Select('album_id', \Modules\App\Models\ImageAlbumModel::find(),array('using' => array('id', 'title')));
		$this->add($album_id);
	}
}