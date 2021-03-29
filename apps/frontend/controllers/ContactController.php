<?php
namespace Modules\Frontend\Controllers;

class ContactController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}
	
	public function indexAction() {
		$this->view->setVar('menu', 'lien-he');
	}

	public function sendAction(){

		$this->view->disable();

		if ($this->request->isPost() && $this->request->isAjax()) {

			$form_data 	= array(
				'fullname'		=> $this->request->getPost('fullname'),
				'phone'				=> $this->request->getPost('phone'),
				'from_email'	=> $this->request->getPost('from_email'),
				'content'			=> $this->request->getPost('content')
			);

			if (!empty($form_data['phone']) || !empty($form_data['from_email'])) {
				$form_data['subject'] = "Liên hệ từ website {$this->config->website}";
				$this->send_mail($form_data);
				die("true");
			}
			else {
				die("false");
			}
		}
		else { die("false"); }
	}

	private function send_mail($form_data = null){

		$mail_settings = $this->config->mail;
		$this->message->setTo(array($mail_settings->to_email));
		$this->message->setSubject($form_data['subject']);
		$this->message->setFrom($mail_settings->from_email, $mail_settings->from_name);
		
		$type = $this->message->getHeaders()->get('Content-Type');
		$type->setValue('text/html');
		$type->setParameter('charset', 'utf-8');
			 
		$view 				= $this->view;
		$view->data 	= $form_data;
		$content_mail = $view->getRender('contact', 'mail',
			array(),
			function($view) { $view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW); }
		);

		$this->message->setBody($content_mail);
		$this->mailer->send($this->message);
	}
}
