<?php
require_once('autoload.php');
try{

	$jsconConfig = file_get_contents("./configs/config.json");
	$config = json_decode($jsconConfig);
	$httpRequest = new HttpRequest($config->basepath);
	$router = new Router();
	$httpRequest->setRoute($router->findRoute($httpRequest,$config->basepath));
	$httpRequest->run($config);
	
}catch(Exception $e){
	$httpRequest = new HttpRequest($config->basepath,"/Error","GET");
	$router = new Router();
	$httpRequest->setRoute($router->findRoute($httpRequest,$config->basepath));
	$httpRequest->addParam($e);
	$httpRequest->run($config);
}


?>