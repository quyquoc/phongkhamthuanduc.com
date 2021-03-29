<?php
	use Phalcon\Loader;
	use Phalcon\Mvc\View;
	use Phalcon\Mvc\Url as UrlProvider;
	use Phalcon\DI\FactoryDefault;
	use Phalcon\Flash\Session as FlashSession;
	use Phalcon\Flash\Direct as Flash;

	/**
	 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
	 */
	$di = new FactoryDefault();

	/**
	 * Register the global configuration as config
	 */
	$di->set('config', $config);

	/**
	 * Database connection is created based in the parameters defined in the configuration file
	 */
	$di->set('db', function() use ($config) {
		return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" 			=> $config->database->host,
			"username" 	=> $config->database->username,
			"password" 	=> $config->database->password,
			"dbname" 		=> $config->database->name,
			"charset" 	=> "utf8",
		));
	});

	/**
	 * Loading routes from the routes.php file
	 */
	$di->set('router', function() {
		return require __DIR__ . '/router.php';
	});

	/**
	 * The URL component is used to generate all kind of urls in the application
	 */
	$di->set('url', function() {

		$script_name = str_replace('//','/',dirname(dirname($_SERVER['SCRIPT_NAME'])));
		$script_name = ($script_name != '/') ? $script_name : '';

		$base_url = 'http' . (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ) ? 's' : '')
							.'://'.$_SERVER['HTTP_HOST'].$script_name;

		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri($base_url);
		return $url;
	});	
	
	$di->set('Ohi', function() {
		$Ohi = new Modules\Library\Oh\Ohi();
		return $Ohi;
	});

	$di->set('GloMenu', function() {
		$GloMenu = new Modules\Library\Oh\GloMenu();
		return $GloMenu;
	});

	/**
	 * Start the session the first time some component request the session service
	 */
	$di->set('session', function() {
		$session = new \Phalcon\Session\Adapter\Files();
		$session->start();
		return $session;
	});

	/**
	 * Register the flash service with custom CSS classes
	 */
	$di->set('flashSession', function(){
		$flash = new FlashSession(array(
			'error'   => 'alert alert-danger alert-dismissible',
			'success' => 'alert alert-success alert-dismissible',
			'notice'  => 'alert alert-info alert-dismissible',
			'warning '=> 'alert alert-warning alert-dismissible'
		));
		$flash->setAutoescape(false);
		return $flash;
	});

	/**
	 * Setup the private resources, if any, for performance optimization of the ACL.  
	 */
	// $di->setShared('AclResources', function() {
	//     $pr = [];
	//     if (is_readable(APP_PATH . '/config/privateResources.php')) {
	//         $pr = include APP_PATH . '/config/privateResources.php';
	//     }
	//     return $pr;
	// });

	/**
	 * Access Control List
	 * Reads privateResource as an array from the config object.
	 */
	// $di->set('acl', function () {
	//     $acl = new Acl();
	//     $pr = $this->getShared('AclResources')->privateResources->toArray();
	//     $acl->addPrivateResources($pr);
	//     return $acl;
	// });