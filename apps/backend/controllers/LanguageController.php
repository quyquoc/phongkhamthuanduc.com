<?php
namespace Modules\Backend\Controllers;
use \Phalcon\Translate\Adapter\NativeArray;
use \Phalcon\Mvc\User\Component;

class LanguageController extends Component {
	
	protected function initialize(){ 
		parent::initialize();
	}

	public function getTranslation() {	

		// Ask browser what is the best language
		$language = $this->getBestLanguage();

		// Check if we have a translation file for that lang
		if (file_exists(dirname(__DIR__)."/messages/" . $language . ".php")) {
			
			require dirname(__DIR__)."/messages/" . $language . ".php";
		} else {
			
			// Fallback to some default
			require dirname(__DIR__)."/messages/en.php";
		}

		// Return a translation object
		return new NativeArray(
			array(
				"content" => $messages
			)
		);
	}

	public function getBestLanguage(){
		return isset($this->member->item->language) ? $this->member->item->language : 'vi';
	}
}

