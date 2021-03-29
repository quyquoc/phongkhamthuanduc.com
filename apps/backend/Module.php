<?php
namespace Modules\Backend;
use \Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class Module {

	public function registerAutoloaders(){

		$loader = new \Phalcon\Loader();

		$loader->registerNamespaces(array(
			'Modules\Backend\Controllers' 	=> __DIR__ . '/controllers/',
			'Modules\Backend\Models' 				=> __DIR__ . '/models/',
			'Modules\Backend\Forms' 				=> __DIR__ . '/forms/',
			'Modules\Library' 							=> __DIR__ . '/../library/'
		));

		$loader->register();
	}

	public function registerServices($di){

		/**
		 * Read configuration
		 */
		$config = include realpath(dirname(dirname(__FILE__)))."/config/config.php";

		$di['dispatcher'] = function() {
			
			$eventsManager = new \Phalcon\Events\Manager();
			$eventsManager->attach('dispatch:beforeException', function($event, $dispatcher, $exception) {
				switch ($exception->getCode()) {
					case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
					case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
						$dispatcher->forward(array(
							'module'		=>'backend',
							'controller'=>'error',
							'action'		=>'error404'
						));
						return false;
				}
			});

			$dispatcher = new \Phalcon\Mvc\Dispatcher();
			$dispatcher->setEventsManager($eventsManager);
			$dispatcher->setDefaultNamespace('Modules\Backend\Controllers');
			return $dispatcher;
		};

		/**
		 * Setting up the view component
		 */
		$di['view'] = function() use ($config) {
			$view = new \Phalcon\Mvc\View();
			$view->setViewsDir(__DIR__ . '/views/');

			$view->registerEngines(array(
				'.volt' => function($view, $di) use ($config)  {

					$volt = new VoltEngine($view, $di);
					$volt->setOptions(array(
						'compiledPath' => $config->application->cacheDir,
						'compiledSeparator' => '_',
						'compileAlways'	=> true
					));
					
					// Extended functions
					$compiler = $volt->getCompiler();
					$compiler->addFunction('in_array', 'in_array');
					$compiler->addFunction('number_format', function ($resolvedArgs, $exprArgs) use ($compiler) {
						$firstArgument = $compiler->expression($exprArgs[0]['expr']);
						return 'number_format('.$firstArgument.", 0, ',', '.')";
					});

					return $volt;
				},
				'.twig' => function($view, $di) use ($config)  {

					require __DIR__."/../library/Twig/Twig.php";
					$options = [];
					$twig = new \Phalcon\Twig\Twig($view, $di, $options);
					$twig->twig->addGlobal('Ohi', new \Modules\Library\Oh\Ohi());
					return $twig;
				},
				'.phtml' => 'Phalcon\Mvc\View\Engine\Php' // Generate Template files uses PHP itself as the template engine
			));
			
			return $view;
		};

		/**
		 * Register a user component LanguageController
		 */
		$di->set('language', function () {
			$language = new \Modules\Backend\Controllers\LanguageController();
			return $language->getTranslation();
		});

		/**
		 *	The config variables define
		 */
		$di->set('define', function() {
			return new \Phalcon\Config(array(
		    'backend' 	=>	'/admin',
		    'password'	=>	'123456'	
			));
		});

		/**
		 * Register a component
		 */
		$di->set('member', function(){
			return new \Modules\Library\Oh\Member();
		});
	}
}