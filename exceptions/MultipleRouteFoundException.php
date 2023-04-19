<?php
class configFileMissingException extends Exception{
	public function __construct($message = "Multiple routes has been found")
	{
		parent::__construct($message, "0004");
	}
}


?>