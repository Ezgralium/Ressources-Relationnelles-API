<?php
class ControllerNotFoundException extends Exception{
	public function __construct($message = "ControllerNotFoundException")
	{
		parent::__construct($message, "0007");
	}
}


?>