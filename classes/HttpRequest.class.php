<?php
	class HttpRequest
	{
		private $url;
		private $method;
		private $param;
		private $route;
		
		public function __construct($basepath,$url = null, $method = null)
		{
			$this->url = (is_null($url))?$this->formateURL($basepath):$url;
			$this->method = (is_null($method))?$_SERVER['REQUEST_METHOD']:$method;
			$this->param = array();
		}
		
		public function getUrl()
		{
			return $this->url;	
		}
		
		public function getMethod()
		{
			return $this->method;	
		}
		
		public function getParams()
		{
			return $this->params;	
		}
		
		public function setRoute($route)
		{
			$this->route = $route;	
		}
		
		private function formateURL($basepath){
			if(isset($_SERVER['PATH_INFO'])){
				return $_SERVER['PATH_INFO'];
			}else{
				$url = str_replace($basepath,'',$_SERVER['REQUEST_URI']);
				return(explode('?',$url)[0]);
			}
			
		}
		
		public function bindParam()
		{
			switch($this->method)
			{
				case "GET":
				case "DELETE":
					foreach($this->route->getParam() as $param)
					{
						if(isset($_GET[$param]))
						{
							$this->param[] = $_GET[$param];
						}
					}
				case "POST":
				case "PUT":
					foreach($this->route->getParam() as $param)
					{
						if(isset($_POST[$param]))
						{
							$this->param[] = $_POST[$param];
						}
					}
			}
		}
		
		public function getRoute()
		{
			return $this->route;	
		}
		
		public function getParam()
		{
			return $this->param;	
		}
		
		public function run($config)
        {
			$this->bindParam();
            $this->route->run($this,$config);
        }
		
		public function addParam($value)
        {
            $this->param[] = $value;
        }
	}