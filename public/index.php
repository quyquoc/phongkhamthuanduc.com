<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Phalcon\Mvc\Application;

try {
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	
	/**
	 * Read the configuration
	 */
	$config = include __DIR__ . "/../apps/config/config.php";

	/**
	 * Include services
	 */
	require __DIR__ . '/../apps/config/services.php';
	require_once __DIR__ . '/../apps/config/namespaceLoader.php';

	/**
	 * Handle the request
	 */
	$application = new Application();
	$application->setDI($di);

	/**
	 * Register application modules
	 */
	$application->registerModules(array(
		'frontend' => array(
			'className' => 'Modules\Frontend\Module',
			'path' 			=> '../apps/frontend/Module.php'
		),
		'backend'	=> array(
			'className' => 'Modules\Backend\Module',
			'path' 			=> '../apps/backend/Module.php'
		)
	));

	/**
	 * Define
	 */
	$script_name = str_replace('//','/',dirname(dirname($_SERVER['SCRIPT_NAME'])));
	$script_name = ($script_name != '/') ? $script_name : '';

	$base_url = 'http' . (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ) ? 's' : '')
						.'://'.$_SERVER['HTTP_HOST'].$script_name;

	define('ROOT_URL', $base_url);
	define('BACKEND_URL', ROOT_URL.'/admin');
	define('UPLOAD_URL', ROOT_URL.'/uploads');
	define('UPLOAD_EXT', 'bmp,gif,jpeg,jpg,png,swf,doc,xls,docx,xlsx,pdf');
	define('UPLOAD_SIZE', '5M');
	define('ROOT_PATH', realpath(dirname(dirname(__FILE__))));
	define('PUBLIC_PATH', ROOT_PATH.'/public');
	define('UPLOAD_PATH', ROOT_PATH.'/public/uploads');

	echo $application->handle()->getContent();
	
} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} 

