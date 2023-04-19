<?php
	class Route
	{
		private $path;
		private $action;
		private $method;
		private $param;
		private $manager;
		private $controller;
		
		public function __construct($route)
		{

			$this->path = $route->path;
			$this->controller = $route->controller;
			$this->action = $route->action;
			$this->method = $route->method;
			$this->param = $route->param;
			$this->manager = $route->manager;
		}
		
		public function getPath()
		{
			return $this->path;
		}
		
		public function getController()
		{
			return $this->controller;
		}
		
		public function getAction()
		{
			return $this->action;
		}
		
		public function getMethod()
		{
			return $this->method;
		}
		
		public function getParam()
		{
			return $this->param;
		}
		
		public function getManager(){
			return $this->manager;
		}
		
		public function run($httpRequest,$config)
		{
			$controller = null;
			$controllerName = $this->controller . "Controller";
            if(class_exists($controllerName)){
                $controller = new $controllerName($httpRequest,$config);
                if(method_exists($controller, $this->action))
                {
				
					// if(count($httpRequest->getParam()) == count($this->getParam())){
                    	$controller->{$this->action}(...$httpRequest->getParam());
					// }else{
					// 	//var_dump("test");
					// 	throw new InvalidParameterNumberException();
					// }
                }
                else
                {
                    throw new ActionNotFoundException();
                }
            }else{
                throw new ControllerNotFoundException();
            }
			
		}
	}