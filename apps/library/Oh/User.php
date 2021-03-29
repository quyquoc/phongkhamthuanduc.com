<?php
namespace Modules\Library\Oh;
use Phalcon\Mvc\User\Component;
use \Modules\Frontend\Models\Guest as Guest;

class User extends Component
{	
	public $item = null;

	public function __construct(){
		$guest = $this->session->get('user_info');
		if(!empty($guest)){
			$this->item = $guest;
		}	
	}

	public function getId(){
		return $this->item['id'];
	}

	public function getUserName(){
		return $this->item['username'];
	}

	public function getFullName(){
		return $this->item['fullname'];
	}

	public function getEmail(){
		return $this->item['email'];
	}

	public function getPicture(){
		return $this->item['picture'];
	}

	public function getPhone(){
		return $this->item['phone'];
	}
}
