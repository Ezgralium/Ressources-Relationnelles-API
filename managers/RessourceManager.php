<?php
	class RessourceManager extends BaseManager{
		
		public function __construct($datasource){
			parent::__construct("ressource","Ressource",$datasource);
		}

		public function getRessourcesHeaders()
		{
			$req = $this->db->prepare("SELECT id, titre, type, imgPath, vues FROM " . $this->table);
			$req->execute();
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->obj);
			return $req->fetchAll();
		}

		public function searchRessource($search)
		{
			$req = $this->db->prepare("SELECT * from " . $this->table . " where titre LIKE ?");
			$req->execute(array('%'.$search.'%'));
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->obj);
			return $req->fetchAll();
		}

		public function setViews($ressourceId, $userId)
		{
			$req = $this->db->prepare("SELECT * FROM ressource_views WHERE ressource_id=? AND user_id=?");
			$req->execute(array($ressourceId,$userId));
			$req->setFetchMode(PDO::FETCH_NUM);
			$req = $req->fetch();
			if(!$req) {
				$req = $this->db->prepare("INSERT INTO ressource_views (ressource_id,user_id) VALUES (?,?)");
				$req->execute(array($ressourceId,$userId));
			}
		}
	}
?>