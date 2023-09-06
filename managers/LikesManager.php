<?php
	class LikesManager extends BaseManager{
		
		public function __construct($datasource){
			parent::__construct("user_likes","UserLikes",$datasource);
		}

        public function getUserLikes($id)
		{
			$req = $this->db->prepare("SELECT ressource_liked FROM user_likes WHERE user=?");
			$req->execute(array($id));
			$req->setFetchMode(PDO::FETCH_NUM);
			$req = $req->fetchAll();
			$likes = array();
			foreach($req as $like) {
				array_push($likes,$like[0]);
			}
			return $likes;
		}

		public function setLike($ressourceId, $userId, $liked){
			$userLikes = new UserLikes();
			$userLikes->user = $userId;
			$userLikes->ressource_liked = $ressourceId;
			$likes = array();
			$likes = $this->getUserLikes($userId);
			echo("test");
			if(in_array($ressourceId, $likes) && !filter_var($liked, FILTER_VALIDATE_BOOLEAN)) {
				// remove
				echo("delete");
				return $this->deleteLike($userLikes);
			}
			else if(!in_array($ressourceId, $likes) && filter_var($liked, FILTER_VALIDATE_BOOLEAN)) {
				// add
				echo("create");
				return $this->create($userLikes,array("user","ressource_liked"));
			}
		}

		public function deleteLike($obj)
		{
			$req = $this->db->prepare("DELETE FROM user_likes WHERE user=? AND ressource_liked=?");
			return $req->execute(array($obj->user, $obj->ressource_liked));
		}
	}
