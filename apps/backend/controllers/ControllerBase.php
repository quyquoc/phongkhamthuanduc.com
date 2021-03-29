<?php
namespace Modules\Backend\Controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller {

	private $model; 

	protected function onConstruct(){
		$this->view->setTemplateAfter('template');
	}

	public function beforeExecuteRoute(Dispatcher $dispatcher){	
		
		$auth = new \Modules\Library\Auth\Auth();

		if(!empty($auth->getIdentity())){
			$acl 			= new \Modules\Library\Acl\Acl();
			$resource = $acl->getInfoPermission();
			$role 		= array(); 
			if($resource){
				foreach($resource as $k => $v){
					if(!in_array($v->privilege->controller, $role)){
						$role[$v->privilege->controller] = $v->privilege->controller;
					}
				}
			}
			$role = $auth->getPermission() === "full" ? 'full' : $role;
			$this->view->role = $role;

			if($auth->getPermission() !== "full"){
				$controllerName = $dispatcher->getControllerName();
				$actionName 		= $dispatcher->getActionName(); 
				if (!$acl->isAllowed($auth->getPermission(), $controllerName, $actionName)) {
					if ($acl->isAllowed($auth->getPermission(), "index", "index")) {
						$this->flashSession->notice($this->language->_('deny_access'));
						$dispatcher->forward(array(
							'module' 			=> 'backend',
							'controller' 	=> 'error',
							'action' 			=> 'error401'
						));
					} else {
						$this->response->redirect($this->define->backend."/error/error404");
					}
				}
			}
		} else {
			$this->response->redirect($this->define->backend."/login");
		}
	}

	public function bulkDelete(){
		if ($this->request->isAjax()) {
			$data_ids = $_POST['data_ids'];
			$list = $this->getModel()->find(array('conditions'	=> "id IN({$data_ids})"));
			if(count($list) > 0){
				foreach ($list as $key => $value) {
					$value->delete();
				}
			} 
		}
	}

	/**
	 *	Create object và edit object
	 *	@param $_POST $post [Dữ liệu là POST]
	 *	@param array $data [Dữ liệu cần thêm ko nằm trong form]
	 *	@return boolean
	 */
	protected function save($post, $model = null, $data = null){

		// model = null là thêm mới , model khác null là sửa
		if($model === null){
			$model = $this->getModel();
		}
		
		$form = $this->getForm($model);
		$form->bind($post, $model); 
		// data != null thêm những trường không có ở trong form
		if($data !== null && is_array($data)){
			foreach ($data as $key => $value) {
				$model->$key = $value;
			}
		}
		
		if ($form->isValid($post, $model)) {
			if($model->save()){
				$this->flashSession->success($this->language->_('alert_success'));
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
			} else {
				$messa = "";
				foreach ($model->getMessages(true) as $attribute => $messages) {
					$messa .= $messages->getMessage()."</br>";
				}
				$this->flashSession->error($this->language->_('alert_danger'));
				return;
			}	
		} else {
			$error = array();
			foreach ($form->getMessages(true) as $attribute => $messages) {
				$error[$attribute] = $attribute;
			}
			$this->flashSession->error($this->language->_('alert_info',array('info'=>$this->language->_('alert_message'))));
			return;
		}
		return $model;
	}	

	/**
	 *	Xóa dữ liệu theo id
	 *	@param string or int $id
	 */
	protected function delete($id){

		$model = $this->getModel();
		$record = $model::findFirstById($id);
		if($record){
			if($record->delete()){
				$this->flashSession->success($this->language->_('alert_success'));
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
				return true;
			}
		}
		
		$this->flashSession->error($this->language->_('alert_danger'));
		$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");

		return false;
	}

	/**
	 *	@param integer $id [ID]
	 *	@return object: 1 record
	 */
	protected function findFirstById($id){
		$model = $this->getModel();
		return $model::findFirstById($id);
	}

	public function get_ip(){
		if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
				$addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
				return trim($addr[0]);
			} else {
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
		else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}

	protected function setModel($model){
		$this->model = $model;
	}

	/*public function index() {	

		if ($this->request->isAjax()) {

			$resultset = $this->modelsManager
												->createQuery($this->getModel()->sql())
												->execute();

			$dataTables = new \Modules\Library\Datatable\DataTable($options = [], $this->getModel());
			$dataTables->fromResultSet($resultset)->sendResponse();
		}

		$this->view->json_data 	= $this->getModel()->json_data();
		$this->view->column 		= json_decode($this->getModel()->json_data(1));
		$this->view->pick("partials/datatable_index");
	}

	protected function setModel($model){
		$this->model = $model;
	}

	protected function getModel(){
		$model = "\Modules\Backend\Models\\".$this->model;
		return new $model();
	}
	
	protected function getForm($model = null){

		$form = "\Modules\Backend\Forms\\".$this->model;
		return new $form($model);
	}*/
}