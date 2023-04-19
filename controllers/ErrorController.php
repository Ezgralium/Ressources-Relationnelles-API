<?php
	class ErrorController
	{
		public function Show($exception)
		{
			if(method_exists($exception,"getMoreDetail")){
				var_dump($exception->getMoreDetail());
			}
			var_dump($exception);
		}
	}