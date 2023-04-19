<?php
	class BaseManager
	{
		protected $table;
		protected $obj;
		protected $db;
		
		public function __construct($table,$object,$datasource)
		{
			$this->table = $table;
			$this->obj = $object;
			$this->db = DB::getInstance($datasource);
		}
		
		public function getById($id)
		{
			$req = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id=?");
			$req->execute(array($id));
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->obj);
			return $req->fetch();
		}
		
		public function getAll()
		{
			$req = $this->db->prepare("SELECT * FROM " . $this->table);
			$req->execute();
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->obj);
			return $req->fetchAll();
		}
		
		public function create($obj,$param)
		{
			$paramNumber = count($param);
			$valueArray = array_fill(1,$paramNumber,"?");
			$valueString = implode($valueArray,", ");
			$sql = "INSERT INTO " . $this->table . "(" . implode($param,", ") . ") VALUES(" . $valueString . ")";
			$req = $this->db->prepare($sql);
			$boundParam = array();
			foreach($param as $paramName)
			{
				if(property_exists($obj,$paramName))
				{
					$boundParam[] = $obj->$paramName;	
				}
				else
				{
					throw new PropertyNotFoundException($this->obj,$paramName);	
				}
			}

			try{
				$res = $req->execute($boundParam);
				return($res);	
			}catch(Exception $e){
				return $e;
			}
			
		}
		
		public function update($obj,$param)
		{
			$sql = "UPDATE " . $this->table . " SET ";
			foreach($param as $paramName)
			{
				$sql = $sql . $paramName . " = ?, ";
			}
			$sql = $sql . " WHERE id = ? ";
			$req = $this->db->prepare($sql);
			
			$param[] = 'id';
			$boundParam = array();
			foreach($param as $paramName)
			{
				if(property_exists($obj,$paramName))
				{
					$boundParam[$paramName] = $obj->$paramName;	
				}
				else
				{
					throw new PropertyNotFoundException($this->object,$paramName);	
				}
			}
			$req->execute($boundParam);
		}
		
		public function delete($obj)
		{
			if(property_exists($obj,"id"))
			{
				$req = $this->db->prepare("DELETE FROM " . $this->table . " WHERE id=?");
				return $req->execute(array($obj->id));
			}
			else
			{
				throw new PropertyNotFoundException($obj,"id");	
			}
		}
	}