<?php
	$configFile = file_get_contents("./configs/folders.json");
	$config = json_decode($configFile);
	spl_autoload_register(function($class) use($config)
	{
		foreach($config->folders as $folder)
		{
			$fileExtension = ".php";
			if($folder === "classes"){
				$fileExtension = ".class.php";
			}
			if(file_exists($folder . '/' . $class . $fileExtension))
			{
				require_once($folder . '/' . $class . $fileExtension);
			}
		}
	});
?>