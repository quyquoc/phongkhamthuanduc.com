<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;

class PermissionGroupPrivilegeModel extends DatatableManagerModel {

	public function getSource() {
		return "permission_group_privilege";
	}

	public function columnMap() {
		return array(
			'id'        	 	=>  'id',
			'privilege_id'  =>  'privilege_id',
			'group_id'			=>  'group_id',
			'status'    		=>  'status'
		);
	}

	public function initialize(){
		$this->belongsTo('privilege_id', '\Modules\App\Models\PermissionPrivilegeModel', 'id', array(
			'alias' 		=> 'privilege',
			'reusable'	=> true
		));
		
		$this->belongsTo('group_id', '\Modules\App\Models\PermissionGroupModel', 'id', array(
			'alias' 		=> 'group',
			'reusable' 	=> true
		));
	}
}