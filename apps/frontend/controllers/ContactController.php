<?php
namespace Modules\Frontend\Controllers;
use Modules\App\Models\ContactModel;
use Modules\App\Models\BookingModel;
class ContactController extends ControllerBase {

	protected function onConstruct(){
		parent::onConstruct();
	}
	
	public function indexAction() {
		$this->view->setVar('menu', 'lien-he');
	}
	public function sendAction(){ 
		$out = array('status'=> 'false', 'content'=>'');
		try {			
			$form_data 	= array(
				'fullname'		=> $this->request->getPost('fullname'),
				'phone'			=> $this->request->getPost('phone'),
				'from_email'	=> $this->request->getPost('from_email'),
				'service'		=> $this->request->getPost('service'),
				'content'		=> $this->request->getPost('content')
			);
			if(!$form_data['phone'] || empty($form_data['phone'])){
				throw new \Exception("Điền thêm số điện thoại");
			}
			$contactModel = new ContactModel();
			$contactModel->fullname = $form_data['fullname'];
			$contactModel->phone = $form_data['phone'];
			$contactModel->email = $form_data['from_email'];
			$contactModel->service = $form_data['service'];
			$contactModel->content = $form_data['content'];
			$contactModel->created = date('Y-m-d H:i:s');
			if(!$contactModel->save()){
				throw new \Exception("Lỗi! Vui lòng gửi lại");
			}
			$form_data['subject'] = "Thông tin liên hệ tư vấn từ {$this->config->website}";
			if($this->send_mail($form_data)) {
				// $this->send_telegram($form_data);
				$out['status'] = 'true';
				$out['content'] = $this->view->getRender('contact', 'mail',
					array(),
					function($view) {
						$view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
					}
				);
				die(json_encode($out));
			}else{
				$this->view->disable();
				$out['content']='Lỗi rồi bạn ơi';
			}
		} catch(\Exception $e){
			$out['content']  = $e->getMessage();
			$this->view->disable();
		}
		die(json_encode($out));
	}
	public function bookAction(){
		
		$out = array('status'=> 'false', 'content'=>'');
		try {			
			$form_data 	= array(
				'fullname'			=> $this->request->getPost('fullname'),
				'phone'				=> $this->request->getPost('phone'),
				'from_email'		=> $this->request->getPost('from_email'),
				'date'				=> $this->request->getPost('date'),
				'time'				=> $this->request->getPost('time'),
				'department_title'	=> $this->request->getPost('department_title'),
			);

			if(!$form_data['phone'] || empty($form_data['phone'])){
				throw new \Exception("Điền thêm số điện thoại");
			}
			$bookingModel = new BookingModel();
			$bookingModel->fullname = $form_data['fullname'];
			$bookingModel->phone = $form_data['phone'];
			$bookingModel->email = $form_data['from_email'];
			$bookingModel->department_title = $form_data['department_title'];
			$bookingModel->from_date = date ('Y-m-d', strtotime($form_data['date']));
			// $bookingModel->from_time = time(' H:i:s', strtotime($form_data['time']));
			$bookingModel->created = date('Y-m-d H:i:s');
			if(!$bookingModel->save()){
				throw new \Exception("Lỗi! Vui lòng gửi lại");
			}
			$form_data['subject'] = "Thông tin đặt hẹn khám từ {$this->config->website}";
			if($this->send_mail($form_data)) {
				// $this->send_telegram($form_data);
				$out['status'] = 'true';
				$out['content'] = $this->view->getRender('contact', 'mail',
					array(),
					function($view) {
						$view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
					}
				);
				die(json_encode($out));
			}else{
				$this->view->disable();
				$out['content']='Lỗi rồi bạn ơi';
			}
		} catch(\Exception $e){
			$out['content']  = $e->getMessage();
			$this->view->disable();
		}
		die(json_encode($out));
	}
	private function send_mail($form_data = null){
		$mail_settings = $this->config->mail;
		$this->message->setFrom($mail_settings->from_email, $mail_settings->from_name);
		$this->message->setTo(array($mail_settings->to_email));
		// $this->message->setBcc(array('cskhmarketing@ohi.vn'));

		$this->message->setSubject($form_data['subject']);
		
		$type = $this->message->getHeaders()->get('Content-Type');
		$type->setValue('text/html');
		$type->setParameter('charset', 'utf-8');
		$view = $this->view;
		$this->view->data = $form_data;
		$content = $view->getRender('contact', 'mail',
			array(),
			function($view) {
				$view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
			}
		);
		$this->message->setBody($content);
		return $this->mailer->send($this->message);
	}
	private function send_telegram($form_data = null){
		try {
			$dataText = "<b>Tài khoản: {$this->config->mail->from_name}</b>";
			$dataText .= "\n{$form_data['subject']}";
			if(!empty($form_data['fullname'])){
				$dataText .= "\nHọ Tên: <b>{$form_data['fullname']}</b>";
			}
			if(!empty($form_data['phone'])){
				$dataText .= "\nSố điện thoại: <b>{$form_data['phone']}</b>";
			}
			if(!empty($form_data['from_email'])){
				$dataText .= "\nEmail: <b>{$form_data['from_email']}</b>";
			}
			if(!empty($form_data['adults'])){
				$dataText .= "\nSố người lớn: <b>{$form_data['adults']}</b>";
			}
			if(!empty($form_data['children'])){
				$dataText .= "\nSố trẻ nhỏ: <b>{$form_data['children']}</b>";
			}
			if(!empty($form_data['arrive'])){
				$dataText .= "\nNgày nhận phòng: <b>{$form_data['arrive']}</b>";
			}
			if(!empty($form_data['depart'])){
				$dataText .= "\nNgày trả phòng: <b>{$form_data['depart']}</b>";
			}
			if(!empty($form_data['province'])){
				$dataText .= "\nTỉnh/thành phố: <b>{$form_data['province']}</b>";
			}
			
			\Modules\Library\Oh\TelegramBot::create()->sendBaseMessageCSKH(
				$dataText,
				true
			);
		} catch (\Exception $e){
			die('Lỗi rồi!');
		}
	}
}
