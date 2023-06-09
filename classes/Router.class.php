<?php
	class Router
	{
		private $listRoute;
		
		public function __construct()
		{
			$stringRoute = file_get_contents('./configs/routes.json');
			$this->listRoute = json_decode($stringRoute);
		}
		
		public function findRoute($httpRequest,$basepath)
		{
			$url = str_replace($basepath,"",$httpRequest->getUrl());
			$method = $httpRequest->getMethod();
			$routeFound = array_filter($this->listRoute,function($route) use ($url,$method){
				return preg_match("#^" . $route->path . "$#", $url) && $route->method == $method;
			});
			$numberRoute = count($routeFound);
			if($numberRoute > 1)
			{
				throw new MultipleRouteFoundException();
			}
			else if($numberRoute == 0)
			{
				throw new NoRouteFoundException($httpRequest);
			}
			else
			{
				return new Route(array_shift($routeFound));	
			}
		}
	}