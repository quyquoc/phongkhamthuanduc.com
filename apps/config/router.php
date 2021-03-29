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

		// More...
		$router->add('/components/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'index',
			'action' 		=> 'components',
			'params'		=> 1
		));
		$router->add('/boxes/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'index',
			'action' 		=> 'boxes',
			'params'		=> 1
		));

		// News
		$router->add('/news/addItem', array(
			'module' 		=> 'frontend',
			'controller'=> 'news',
			'action' 		=> 'addItem'
		));

		// Shop
		$router->add('/san-pham/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'shop',
			'action' 		=> 'index',
			'params'		=> 1
		));
		$router->add('/san-pham/tim-kiem', array(
			'module' 		=> 'frontend',
			'controller'=> 'shop',
			'action' 		=> 'search',
		));
		$router->add('/san-pham/addItem', array(
			'module' 		=> 'frontend',
			'controller'=> 'shop',
			'action' 		=> 'addItem'
		));
		$router->add('/gio-hang/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'shop',
			'action' 		=> 'viewCart',
			'params'		=> 1
		));
		$router->add('/cap-nhat-gio-hang/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'shop',
			'action' 		=> 'updateCart',
			'params'		=> 1
		));
		$router->add('/xem-gio-hang', array(
			'module' 		=> 'frontend',
			'controller'=> 'shop',
			'action' 		=> 'cartDetail'
		));
		$router->add('/dat-hang', array(
			'module' 		=> 'frontend',
			'controller'=> 'shop',
			'action' 		=> 'order',
		));

		// Project
		$router->add('/du-an/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'project',
			'action' 		=> 'index',
			'params' 		=> 1
		));
		$router->add('/du-an/addItem', array(
			'module' 		=> 'frontend',
			'controller'=> 'project',
			'action' 		=> 'addItem'
		));

		// Multimedia
		$router->add('/thu-vien/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'image',
			'action' 		=> 'index',
			'params'		=> 1
		));
		$router->add('/add_image', array(
			'module' 		=> 'frontend',
			'controller'=> 'image',
			'action' 		=> 'addItem'
		));

		// Recruitment
		$router->add('/tuyen-dung/:params', array(
			'module' 		=> 'frontend',
			'controller'=> 'recruitment',
			'action' 		=> 'index',
			'params'		=> 1
		));
		$router->add('/tuyen-dung/addItem', array(
			'module' 		=> 'frontend',
			'controller'=> 'recruitment',
			'action' 		=> 'addItem'
		));

		// FAQs
		$router->addGet('/faqs/:params', array(
			'module' 			=> 'frontend',
			'controller'	=> 'qa',
			'action' 			=> 'index',
			'params'			=> 1
		));
		$router->addPost('/faqs', array(
			'module' 			=> 'frontend',
			'controller'	=> 'qa',
			'action' 			=> 'addQuestion'
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