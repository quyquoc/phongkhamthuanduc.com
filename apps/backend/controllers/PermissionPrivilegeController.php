<?php
namespace Modules\Backend\Controllers;

class PermissionPrivilegeController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
		$this->setModel("PermissionPrivilegeModel");
		$this->view->_controller = 'Quyền hạn';
	}

	public function indexAction() {	
    $this->view->col_order 	= 1;
		$this->index();
	}

	public function addAction(){

		$this->view->_action = 'Thêm mới';

		$this->view->form = $this->getForm();
		if ($this->request->isPost() == true) { 
  		$this->save($_POST);
  	}
	}

	public function editAction($id){
		
		$this->view->_action = 'Chỉnh sửa';

		$model = $this->findFirstById($id);
		$this->view->form = $this->getForm($model);

		if ($this->request->isPost() == true) { 
  		$this->save($_POST,$model);
  	}
  	$this->view->pick('permission-privilege/add');
	}

	public function deleteAction($id){
    $this->delete($id);  
	}
}

