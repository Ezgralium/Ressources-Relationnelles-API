<?php
class NoRouteFoundException extends Exception{
	private $httpRequest;	
	public function __construct($httpRequest,$message = "No route has been found")
	{
		$this->httpRequest = $httpRequest;
		parent::__construct($message, "0003");
	}
	
	
	public function getMoreDetail()
{
	return "Route '" . $this->httpRequest->getUrl() . "' has not been found with method '" . $this->httpRequest->getMethod() . "'\n";
}
	
	
}


?>