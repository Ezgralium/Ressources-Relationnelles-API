<?php
	class CommentManager extends BaseManager{
		
		public function __construct($datasource){
			parent::__construct("comment","Comment",$datasource);
		}

		public function getRessourceComments($ressourceId)
		{
			$req = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE ressource =?");
			$req->execute(array($ressourceId));
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->obj);
			return $req->fetchAll();
		}
	}
