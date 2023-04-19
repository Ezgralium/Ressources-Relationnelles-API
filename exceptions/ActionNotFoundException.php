<?php
class ActionNotFoundException extends Exception{
	public function __construct($message = "ActionNotFoundException")
	{
		parent::__construct($message, "0009");
	}
}


?>