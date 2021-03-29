<?php
namespace Modules\Library\Oh;
use Phalcon\Mvc\User\Component;

class Server extends Component {	
	
	private $server;

	public function __construct(){
		
		// error reporting (this is a demo, after all!)
		ini_set('display_errors',1);error_reporting(E_ALL);

		\OAuth2\Autoloader::register();

		// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
		$storage = new \OAuth2\Storage\Pdo($this->config->oauth->toArray());

		// Pass a storage object or array of storage objects to the OAuth2 server class
		$this->server = new \OAuth2\Server($storage);

		// Add the "Client Credentials" grant type (it is the simplest of the grant types)
		$this->server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

		// Add the "Authorization Code" grant type (this is where the oauth magic happens)
		$this->server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
	}

	public function get(){
		return $this->server;
	}
}