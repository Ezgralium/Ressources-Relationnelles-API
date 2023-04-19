<?php

class DB extends PDO{
	
	private $config;
	private static $instance;
	private $db;
	
	public static function getInstance($datasource)
	{
		if(empty(self::$instance))
		{
			self::$instance = new DB($datasource);
		}
		return self::$instance->db;;
	}
	private function __construct($config)
	{
		try{
			$this->db = new PDO('mysql:dbname=' . $config->dbName . ';host=' . $config->dbHost,
								$config->dbUser,
								$config->dbPwd);
		}catch(Exception $e){
			throw new DatabaseConnectionError;
		}
	}
	
	
}




?>