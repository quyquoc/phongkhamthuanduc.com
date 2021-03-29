<?php
namespace Modules\Library\Acl;
use Phalcon\Mvc\User\Component;
use Modules\Library\Auth\Auth as Auth;
use Modules\Backend\Module;
use Phalcon\Acl\Adapter\Memory as AcList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;

class Acl extends Component {

	public function __construct(){		
		$resources = $this->getInfoPermission();
	}
	
	public function isAllowed($profile, $controller, $action){
		if($this->getAcl()){
			return $this->getAcl()->isAllowed($profile, $controller, $action);
		}
	}
	
	public function getInfoPermission(){
  
		$auth 		= new Auth();
		$identity = $auth->getIdentity();
		if($identity != null){
			
			$group = \Modules\App\Models\PermissionGroupModel::findFirst(array(
				"conditions" 	=> "id = :id: AND status = 1", 
				"bind" 				=> array("id" => $identity['group_id'])
			));
		   
			if(!$group)
				return false;
			
			$group_privilege = \Modules\App\Models\PermissionGroupPrivilegeModel::find(array(
				"conditions" 	=> "group_id = :group_id: AND status = 1",
				"bind" 				=> array("group_id" => $group->id)
			));
			
			if(count($group_privilege) <= 0)
				return false;	
			
			return $group_privilege;
		}  	
		   
		return false;
	}
		
	public function getAcl(){
		
		$auth = new Auth();
		if(!empty($auth->getPermission())){
			$acl = new AcList();
			$acl->setDefaultAction(\Phalcon\Acl::DENY);
			$role = new Role($auth->getPermission());
			$acl->addRole($role);
			 
			$info = $this->getInfoPermission();			
			foreach ($info as $k => $v){  
				$acl->addResource(new Resource($v->privilege->controller), $v->privilege->action);
				$acl->allow($auth->getPermission(), $v->privilege->controller, $v->privilege->action);
			}			
			return $acl;		
		} else {
			return false;	
		}
	}
}
