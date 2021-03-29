<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {

	protected $trust_ip 	= FALSE;
	protected $trust_uri	= "";

	protected function onConstruct(){
		$this->view->assets 			= $this->url->get().'/frontend/home';
		$this->view->frontend 		= $this->url->get().'/frontend';
		$this->view->assets_dir		= '/frontend/home';
		$this->view->setTemplateAfter('template');
		if($this->trust_ip==TRUE){
			$this->trust_ip($this->trust_uri);
		}
	}

	protected function trust_ip($redirect_uri = NULL) {

		$ip 			= $this->get_ip();
		$ip_list 	= $this->list_ip();
		
		if(empty($ip_list) || !in_array($ip, $ip_list)){

			if(!empty($redirect_uri)){
				$this->response->redirect($redirect_uri);
			} else {
				$this->response->redirect('/401');
			}			
		}
	}

	protected function get_ip() {

		$ip;
		
		if(getenv("HTTP_X_FORWARDED_FOR"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");

		else if (getenv("HTTP_X_REAL_IP"))
			$ip = getenv("HTTP_X_REAL_IP");

		else if (getenv("HTTP_CLIENT_IP"))
			$ip = getenv("HTTP_CLIENT_IP");

		else if (getenv("HTTP_X_CLIENT_IP"))
			$ip = getenv("HTTP_X_CLIENT_IP");

		else if(getenv("HTTP_X_CLUSTER_CLIENT_IP"))
			$ip = getenv("HTTP_X_CLUSTER_CLIENT_IP");

		else if(getenv("REMOTE_ADDR"))
			$ip = getenv("REMOTE_ADDR");
		
		else
			$ip = "UNKNOWN";
		
		$ip = explode(',', $ip);
		return $ip[0];
	}

	protected function list_ip(){

		$ips 	= array();
		$path = realpath(ROOT_PATH.'/public/static/ip.txt');

		if($path && is_file($path) && file_exists($path)){

			$file = @file_get_contents($path);
			if($file) {
				$file 	= preg_replace('/\[[^\]]+\]/', '', $file);
				$ips 	= preg_split('/[\n\s,]+/', $file);
			}
		}

		return $ips;
	}
}

