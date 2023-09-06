<?php
	class UserManager extends BaseManager{
		
		public function __construct($datasource){
			parent::__construct("user","User",$datasource);
		}
		
		public function getByMail($mail)
		{
			$req = $this->db->prepare("SELECT id,mail,nom,prenom,alias,salt,profile_picture_path,id_role FROM user WHERE mail=?");
			$req->execute(array($mail));
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"User");
			$user = $req->fetch();
			return $user;
		}
		
		public function Login($login)
		{
			$req = $this->db->prepare("SELECT * FROM user WHERE mail=?");
			$req->execute(array($login));
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"User");
			$result = $req->fetch();
			if($result != false){
				$response = array(  "status"=>"success",
										"code"=>"0001",
										"message"=>"Query success",
                                        "password"=>$result->password);
			}else{
				$response = array(  "status"=>"error",
									"code"=>"0099",
									"message"=>"No user with this email");
			}
		return $response;
		}

		public function confirmAccount($mail,$code){
			$req = $this->db->prepare("SELECT * FROM user WHERE mail=? AND activation_code = ?");
			$req->execute(array($mail,$code));
			$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"User");
			$result = $req->fetch();
			if($result != false){
					$req = $this->db->prepare("UPDATE user set account_confirmed = 1 WHERE mail=? AND activation_code = ?");
					$req->execute(array($mail,$code));
					$req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"User");
					$finalResult = $req->fetch();
					if($finalResult != false){
						$response = array( 
							"status"=>"success",
							"code"=>"0001",
							"message"=>"No user with this email");
					}
					else{
						$response = array( 
							"status"=>"error",
							"code"=>"0099",
							"message"=>"Erreur lors de la confirmation");
					}
			}else{
				$response = array(
					"status"=>"error",
					"code"=>"0099",
					"message"=>"No user with this email nor code");
			}
			return $response;
		}

	}
?>