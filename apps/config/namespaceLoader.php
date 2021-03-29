<?php
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;

$loader = new Loader();

$loader->registerNamespaces(
	[
		'Modules\App\Models' => '../apps/app/models/',
		'Modules\App\Forms'  => '../apps/app/forms/'
	]
);

$loader->register();