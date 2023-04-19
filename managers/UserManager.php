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
			return $req->fetch();
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
	}
?>