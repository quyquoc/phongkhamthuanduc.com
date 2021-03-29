<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Paginator\Pager;
use Modules\App\Models\QaModel;

class QaController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}

	public function indexAction($code=null) {
		if(!empty($code)){
			$item = QaModel::findFirstByCode($code);
			if($item){
				// update hits
				$faqs = $item;

				$this->view->head = array(
					'title'				=>  $faqs->question,
					'url'		 			=> $this->url->get("/faqs/".$item->code)
				);
			
				$this->view->menu = 'faqs';
				$this->view->faqs 	= $item;
				$this->view->pick("qa/detail");
			}
			else { $this->response->redirect('/faqs'); }
		}else{
			$list_item = QaModel::findFinished();
			$count = $list_item->count();
			if($count < 1) {
				$this->response->redirect();
			}
			$view_data = [
				'menu'			=> 'faqs',
				'list_item' => $list_item
			];
		
			$this->view->setVars($view_data);
			$this->assets->addJs('/library/sticky-sidebar-master/rAF.js')
						 ->addJs('/library/sticky-sidebar-master/ResizeSensor.js')
						 ->addJs('/library/sticky-sidebar-master/sticky-sidebar.js');
		}
	}

	public function addQuestionAction() {
		$post = $this->request->getPost();
		$form = new \Modules\App\Forms\QaFrom();
		$model = new QaModel();
		$form->bind($post, $model);
		$model->isfinished = 0;
		if ($form->isValid($_POST, $model)){
			if($model->save()){
				$this->flashSession->success("Gửi câu hỏi thành công");
			} else {
				$this->flashSession->error("Hệ thống bận");
			}
		} else {
			
			$this->view->fullname = $post['fullname'] ? $post['fullname'] : '';
			$this->view->phone 		= $post['phone'] ? $post['phone'] : '';
			$this->view->email 		= $post['email'] ? $post['email'] : '';
			$this->view->question = $post['question'] ? $post['question'] : '';

			$attr = "";
			foreach ($form->getMessages(true) as $attribute => $messages) {
				if(!empty($attr)) $attr .= ", ";
				$attr .= "{$attribute}";
			}
			$message = "Vui lòng nhập đầy đủ thông tin: Họ Tên, Điện thoại, Nội dung";
			// $message = str_replace(['fullname', 'phone', 'email', 'question'], ['Họ Tên', 'Điện thoại', 'Email', 'Nội dung'], $message);
			$this->flashSession->error($message);
		}
		$this->response->redirect("/faqs");
	}
}
