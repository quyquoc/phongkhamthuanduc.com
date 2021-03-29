<?php
namespace Modules\Backend\Controllers;

class BackendController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}

	public function indexAction($_format = null, $id = null) {	
		$model = $this->model::init();
		switch($_format){
			case 'datatable':
				$json_data = $model->json_data();
				die(json_encode($json_data));
				break;
			case 'add':
				return $this->dataUpdate($this->request);
				break;
			case 'update':
				if(!$id) {
					$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName());
				}
				return $this->dataUpdate($this->request, $id);
				break;
			case 'delete':
				if((int)$id>0){
					$record = $this->model::findFirstById($id);
					if($record){
						if($record->delete()){
							$this->flashSession->success($this->language->_('alert_success'));
							$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
							return true;
						}
					}
				}
				$this->flashSession->error($this->language->_('alert_danger'));
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName()."/index");
				return false;
				break;
			case 'checkChangeStatus':
				return $this->checkChangeStatus();
				break;
			default:
				$this->assets->addCss('/library/datatables.net/css/jquery.dataTables.min.css');
				$this->assets->addJs('/library/datatables.net/js/jquery.dataTables.min.js');
				$this->view->DatatableManage = $model->dt_init();
				$this->view->pick("partials/datatable_v2_index");
				break;
		}
	}

	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){

		\Modules\Library\Oh\CkfinderLib::init();

		$this->assets->addCss('/library/bootstrap/css/bootstrap-datetimepicker.min.css');
		$this->assets->addJs('/library/moment/moment.min.js')
								 ->addJs('/library/bootstrap/js/bootstrap-datetimepicker.min.js');

		$model = new $this->model();	
		$user = $this->session->get('auth-oh');

		if($id && $id > 0){
			$this->view->_action = 'Chỉnh sửa';

			$model = $this->model::findFirstById($id);
			if(!$model){
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName());
			} else {
				
				if(isset($model->title) && isset($model->code)) {
					$model->code = $model->createSlug('title');
				}
				$model->editor_id = $user['id'];
				$model->updated 	= date("Y-m-d H:i:s");
				$this->view->model = $model;
			}
		}else {
			$this->view->_action = 'Thêm mới';

			if(isset($model->title) && isset($model->code)) {
				$model->code = $this->request->getPost("code");
				$model->code = $model->createSlug('title');
			}
			$model->creator_id 	= $user['id'];
			$model->created 		= date("Y-m-d H:i:s");
		}
		
		$form = new $this->form($model);
		if ($this->request->isPost() == true){
			$form->bind($this->request->get(), $model);
			if($form->isValid()){				
				if($beforeSave && is_callable($beforeSave)){
					call_user_func_array($beforeSave, [&$model]);
				}
				if($model->save()){								
					if($afterSave && is_callable($afterSave)){
						$model = call_user_func_array($afterSave, [$model]);
					}
					$this->flashSession->success($this->language->_('alert_success'));
					$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName());
					return;
				}
				$this->flashSession->error($this->language->_('alert_danger'));
			} else {
				$this->flashSession->error($this->language->_('alert_info',array('info'=>$this->language->_('alert_message'))));
			}
		}
		$this->view->form = $form;
	}

	//Thay đổi trạng thái
	public function checkChangeStatus(){
		$id = $this->request->get('id');
		$value = $this->request->get('value');
		$field = $this->request->get('field');
		$model = $this->model::findFirstById($id);

		$result = array(
			'Code' => 0,
			'Msg'  => 'Có lỗi xảy ra!',
			'Data' => (int)$value,
			'field'=> $field,
			'id'	 => (int)$id,
			'value'=> (int)$value
		);

		$text = '';
		if($field == 'status') {
			$text = 'trạng thái';
			$model->status = $value;//Giá trị trạng thái muốn thay đổi
		}
		if($field == 'featured') {
			$text = 'nổi bật';
			$model->featured = $value;//Giá trị trạng thái muốn thay đổi
		}
		
		$model->updated = date("Y-m-d H:i:s");
		if($model->save()){
			$result['Code'] = 1;
			$result['Msg'] = 'Cập nhật '.$text.' thành công!';
		} else {
			$result['Msg'] = 'Cập nhật '.$text.' thất bại!';
		}
		die(json_encode($result));
	}	
}