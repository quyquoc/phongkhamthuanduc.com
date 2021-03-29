<?php
namespace Modules\Backend\Controllers;

class SysLanguageController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
		$this->setModel("Sys_language");
		$this->view->_controller = 'Ngôn ngữ';
	}

	public function indexAction() {	
		$this->index();
	}

	public function addAction(){
		
		$this->view->_action 	= 'Thêm mới';
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
  	$this->view->pick('sys-language/add');
	}

	public function deleteAction($id){
		$this->delete($id);  
	}
}

