<?php
class PropertyNotFoundException extends Exception{
    private $obj;
    private $property;
	public function __construct($obj,$property,$message = "Property not found")
	{
        $this->obj = $obj;
        $this->property = $property;
		parent::__construct($message, "0009");
	}
	
public function getMoreDetail(){
    return "Class $this->obj has no property named $this->property";
}

	
}


?>