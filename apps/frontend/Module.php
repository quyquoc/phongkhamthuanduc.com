<?php
namespace Modules\Frontend;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Dispatcher as Dispatcher;

class Module {

	public function registerAutoloaders(){

		$loader = new \Phalcon\Loader();

		$loader->registerNamespaces(array(
			'Modules\Frontend\Controllers' 	=> __DIR__ . '/controllers/',
			'Modules\Frontend\Models' 			=> __DIR__ . '/models/',
			'Modules\Frontend\Forms' 				=> __DIR__ . '/forms/',
			'Modules\Frontend\Elements' 		=> __DIR__ . '/elements/',
			'Modules\Library' 							=> __DIR__ . '/../library/',
			'Phalcon' 											=> __DIR__ . '/../library/Phalcon/'
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
							'module'		=>'frontend',
							'controller'=>'error',
							'action'		=>'show404'
						));
						return false;
				}
			});

			$dispatcher = new \Phalcon\Mvc\Dispatcher();
			$dispatcher->setEventsManager($eventsManager);
			$dispatcher->setDefaultNamespace('Modules\Frontend\Controllers');

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
					$compiler->addFunction('strtotime', 'strtotime');
					$compiler->addFunction('in_array', 'in_array');
					$compiler->addFunction('number_format', function ($resolvedArgs, $exprArgs) use ($compiler) {
						$firstArgument = $compiler->expression($exprArgs[0]['expr']);
						return 'number_format('.$firstArgument.", 0, ',', '.')";
					});

					return $volt;
				},
				'.phtml' => 'Phalcon\Mvc\View\Engine\Php' // Generate Template files uses PHP itself as the template engine
			));
			return $view;
		};

		/**
		 *	Register a component send mail
		 */
		require_once PUBLIC_PATH . '/library/swiftmailer/lib/swift_required.php';
		$di->set('mailer', function () use ($config) {
			$transport = \Swift_SmtpTransport::newInstance($config->mail->smtp->server, $config->mail->smtp->port,$config->mail->smtp->security)
									->setUsername($config->mail->smtp->username)
									->setPassword($config->mail->smtp->password);
			$mailer = \Swift_Mailer::newInstance($transport);
			return $mailer;
		});
		$di->set('message', function () use ($config) {
			return \Swift_Message::newInstance();
		});

		/**
		* Register component
		*/
		$di->set('element', function(){
			return new \Modules\Frontend\Elements\Element();
		});
		$di->set('factory', function(){
			return new \Modules\Library\Oh\Factory();
		});
		$di->set('user', function(){
			return new \Modules\Library\Oh\User();
		});
	}
}