<?php
	class BaseController
	{
		private $httpRequest;
		private $param;
		private $config;
		
		public function __construct($httpRequest,$config)
		{
			$this->httpRequest = $httpRequest;
			$this->config = $config;
			$this->param = array();
			$this->addParam("httprequest",$this->httpRequest);
			$this->addParam("config",$this->config);
			$this->bindManager();
		}
		
		public function bindManager()
		{
 			foreach($this->httpRequest->getRoute()->getManager() as $manager)
			{
				$manager .= "Manager";
				$this->$manager = new $manager($this->config->database);
			}
		}
		
		public function addParam($name,$value)
		{
			$this->param[$name] = $value;
		}
	}