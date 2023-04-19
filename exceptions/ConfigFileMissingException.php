<?php
class configFileMissingException extends Exception{
	public function __construct($message = "Config file missing")
	{
		parent::__construct($message, "0002");
	}
}


?>