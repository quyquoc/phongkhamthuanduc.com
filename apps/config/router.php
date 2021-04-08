<?php
	/**
	 * Registering a router
	 */
	$router = new \Phalcon\Mvc\Router(false);
	$router->removeExtraSlashes(true);
	$router->setDefaultModule("frontend");
	$router->setDefaultAction("index");
	$router->setDefaultController("index"); 
	
	/* Frontend */
		$router->add('/:controller', array(
			'module' 		=> 'frontend',
			'controller'=> 1,
			'action' 		=> 'index'
		));
		$router->add('/:controller/:action', array(
			'module' 		=> 'frontend',
			'controller'=> 1,
			'action' 		=> 2
		));
		$router->add('/:controller/:action/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 1,
			'action' 		=> 2,
			'params'		=> 3
		));
		$router->add('/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'news',
			'action' 		=> 'index',
			'params' 		=> 1
		));
		$router->add('/', array(
			'module' 		=> 'frontend',
			'controller'=> 'index',
			'action' 		=> 'index',
			'segment' 	=> 'home',
		));
		$router->add('/401', array(
			'module' 		=> 'frontend',
			'controller'=> 'error',
			'action' 		=> 'show401'
		));
		$router->add('/404', array(
			'module' 		=> 'frontend',
			'controller'=> 'error',
			'action' 		=> 'show404'
		));

		// News
		$router->add('/news/addItem', array(
			'module' 		=> 'frontend',
			'controller'=> 'news',
			'action' 		=> 'addItem'
		));

		// Service
		$router->add('/chuyen-khoa', array(
			'module' 		=> 'frontend',
			'controller'	=> 'service',
			'action' 		=> 'clinic',
			'page' 			=> 'chuyen-khoa',
		));
		$router->add('/chuyen-khoa/{code}', array(
			'module' 		=> 'frontend',
			'controller'	=> 'service',
			'action' 		=> 'detail',
			'page' 			=> 'chuyen-khoa',
			'params'		=> 1
		));
		$router->add('/dich-vu', array(
			'module' 		=> 'frontend',
			'controller'	=> 'service',
			'action' 		=> 'service',
			'page' 			=> 'dich-vu'
		));

		// Multimedia
		$router->add('/thu-vien/:params', array(
			'module' 		=> 'frontend',
			'controller'    => 'image',
			'action' 		=> 'index',
			'params'		=> 1
		));
		$router->add('/add_image', array(
			'module' 		=> 'frontend',
			'controller'	=> 'image',
			'action' 		=> 'addImage'
		));



		// Contact
		$router->add('/lien-he', array(
			'module' 		=> 'frontend',
			'controller'=> 'contact',
			'action' 		=> 'index'
		));
		$router->add('/gui-lien-he', array(
			'module' 		=> 'frontend',
			'controller'=> 'contact',
			'action' 		=> 'send'
		));

	/* Backend */
		$router->add("/admin", array(
			'module' 		=> 'backend',
			'controller'=> 'index',
			'action' 		=> 'index',
		));
		$router->add('/admin/:controller', array(
			'module' 		=> 'backend',
			'controller'=> 1,
			'action' 		=> 'index',
		));
		$router->add('/admin/:controller/:action', array(
			'module' 		=> 'backend',
			'controller'=> 1,
			'action' 		=> 2,
		));
		$router->add('/admin/:controller/:action/:params', array(
			'module' 		=> 'backend',
			'controller'=> 1,
			'action' 		=> 2,
			'params'		=> 3,
		));

	return $router;