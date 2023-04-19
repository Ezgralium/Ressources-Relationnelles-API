<?php
class databaseConnectionError extends Exception{
	public function __construct($message = "Database connection error")
	{
		parent::__construct($message, "0001");
	}
}


?>