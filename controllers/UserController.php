 <?php

	class UserController extends BaseController
	{		
		public function Authenticate($login)
		{
			echo json_encode($this->UserManager->login($login));
		}

				


		public function Register($mail,$alias,$lastName,$firstName,$password)
		{
			//var_dump($this->UserManager);die();
			$user = new User();
			$user->mail = $mail;
			$user->alias = $alias;
			$user->nom = $lastName;
			$user->prenom = $firstName;
			$user->password = $password;
			//echo json_encode($this->UserManager->getAll());
			$result = $this->UserManager->create($user,array("mail","alias","nom","prenom","password"));
			if($result){
				echo json_encode(array("status"=>"success","code"=>"0001","message"=>"Account created"));

			}else{
				echo json_encode(array("status"=>"error","code"=>"0099","message"=>"Error while inserting into database"));
			}
		}
		
		public function getInfos($mail){
			echo json_encode($this->UserManager->getByMail($mail));
		}
	}