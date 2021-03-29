<?php

namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;

class NewsletterController extends Controller{

	private $params = array();

	protected function onConstruct(){

		$this->view->setTemplateAfter('template');
		
		$this->params = $this->dispatcher->getParams();
		$this->view->setVar('params', $this->params);
		$this->view->setVar('menu', 'lien-he');
	}
	
	public function indexAction(){}

	public function sendAction(){

    $this->view->disable();

		if ($this->request->isAjax()) {

			$info				= $this->request->get('info');
			$project_id	= (int)$this->request->get('project_id');

			$newsletter = new \Modules\Frontend\Models\Newsletter();
			$item = $newsletter::findByInfo($info);
			if(count($item) == 0){
				$newsletter->info = $info;
				$newsletter->project_id = !empty($project_id) ? $project_id : 0;
				$newsletter->created = date('Y-m-d H:i:s');

				if($newsletter->save()){
					echo "true";
				}else{
					echo "false";
				}
			}else{
				echo "true";
			}
		}
	}
}
