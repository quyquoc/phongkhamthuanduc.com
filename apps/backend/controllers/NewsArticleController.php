<?php
namespace Modules\Backend\Controllers;
use Modules\App\Models\NewsArticleModel;
use Modules\App\Models\NewsArticleCategoryModel;
use Modules\App\Forms\NewsArticleForm;

class NewsArticleController extends BackendController {

	protected function onConstruct(){
		parent::onConstruct();
    $this->model = "\Modules\App\Models\NewsArticleModel";
    $this->form = "\Modules\App\Forms\NewsArticleForm";
		$this->view->_controller = 'Bài viết';
		$this->view->col_order   = 6;
		$this->view->page_length = 50;
	}

	public function dataUpdate($request, $id = null, $beforeSave = null, $afterSave = null){
		\Modules\Library\Oh\CkfinderLib::init();

		$this->assets->addCss('/library/bootstrap/css/bootstrap-datetimepicker.min.css');
		$this->assets->addJs('/library/moment/moment.min.js')
								 ->addJs('/library/bootstrap/js/bootstrap-datetimepicker.min.js');
		
		$model = new NewsArticleModel();		
		if($id && $id > 0){
			$model = NewsArticleModel::findFirstById($id);
			if(!$model){
				$this->response->redirect($this->define->backend.'/'.$this->router->getControllerName());
			}
			// if($model->status == 0) {
			// 	$model->status = 1 ;
			// 	$model->save();
			// }
		}else {
			$model->creator_id = $user['id'];
			$model->created 		= date('Y-m-d H:i:s');
		}

		$form = new NewsArticleForm($model);

		if ($this->request->isPost() == true){
      $form->bind($this->request->get(), $model);
			$category = $this->request->getPost("category_id");
			if(!$category || empty($category)){
				$this->flashSession->error('Vui lòng chọn một danh mục');
				return;
			}

			if($form->isValid()){
				$user = $this->session->get('auth-oh');
				$model->code = $this->request->getPost("code");
				$model->code = $model->createSlug('title');
				$model->published = date ('Y-m-d H:i:s', strtotime($this->request->getPost("published")));
				$model->category_id = $category[0];

				if($id && $id > 0){
					$model->editor_id = $user['id'];
					$model->updated 	= date('Y-m-d H:i:s');
				}else {
					$model->creator_id 	= $user['id'];
					$model->created 		= date('Y-m-d H:i:s');
				}

				if($model->save()){
					$news_category_delete = NewsArticleCategoryModel::findByNews_id($model->id);
					foreach ($news_category_delete as $key => $row) {
						$news_category_delete->delete();
					}

          for($i = 0; $i < count($category); $i++){ 
            $news_category = new NewsArticleCategoryModel();
            $news_category->news_id     = $model->id;
            $news_category->category_id = $category[$i];
            $news_category->save();
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
    return $this->view->pick('news-article/index');
	}	
}

