<?php
namespace Modules\Library\Oh;
use Phalcon\Mvc\User\Component;

class Member extends Component {	
	public $item;

	public function __construct(){
		$this->item = \Modules\App\Models\MemberModel::findFirstById($this->session->get('auth-oh')['id']);
	}	
}