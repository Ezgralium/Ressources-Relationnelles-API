<?php
class InvalidParameterNumberException extends Exception{
	public function __construct($message = "Invalid parameter number exception")
	{
		parent::__construct($message, "0077");
	}
}


?>