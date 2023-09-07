 <?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

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
			$user->activation_code = $user->generateRandomString();
			$user->activation_expiration = date('Y-m-d H:i:s', strtotime('+1 day', strtotime("now"))); 
			//var_dump(date('Y-m-d H:i:s', strtotime('+1 day', strtotime("now"))));
			//echo json_encode($this->UserManager->getAll());
			$result = $this->UserManager->create($user,array("mail","alias","nom","prenom","password","activation_code","activation_expiration"));
			if($result){

				require 'assets/libraries/PHPMailer/src/PHPMailer.php';
				require 'assets/libraries/PHPMailer/src/SMTP.php';
				require 'assets/libraries/PHPMailer/src/Exception.php';

				

				$message = '<!DOCTYPE html>
							<html>
							<head>
								<meta charset="UTF-8">
								<title>Confirmation de compte</title>
							</head>
							<body>
								<p>Bonjour '.$user->alias.'</p>
								<p>Merci de vous être inscrit sur notre site !</p>
								<p>Pour confirmer votre compte, veuillez cliquer sur le lien ci-dessous :</p>
								<a href="https://api.ezraspberry.com/api/v1/Confirmation?mail='.$user->mail.'&code='.$user->activation_code.'">Confirmer votre compte</a>
								<p>Après la confirmation, vous pourrez accéder à toutes les fonctionnalités de notre site.</p>
								<p>Merci de nous avoir rejoint !</p>
								<p>Cordialement,</p>
								<p>L\'équipe (Re)Source Relationelle</p>
							</body>
							</html>';

				$mail = new PHPMailer(true);

				try {
					// Paramètres SMTP de Gmail
					$mail->SMTPDebug = SMTP::DEBUG_OFF;  // Niveau de débogage (DEBUG_OFF, DEBUG_SERVER, DEBUG_CLIENT, etc.)
					$mail->isSMTP();
					$mail->Host       = 'smtp.gmail.com';
					$mail->SMTPAuth   = true;
					$mail->Username   = 'ezraspberry@gmail.com'; // Votre adresse e-mail Gmail
					$mail->Password   = 'upgt gsph wevc rrqr';   // Votre mot de passe Gmail
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Chiffrement TLS (ou SSL)
					$mail->Port       = 587; // Port SMTP (TLS)
 					$mail->isHTML(true);
					// Destinataire et contenu de l'e-mail
					$mail->setFrom('ezraspberry@gmail.com', 'Ressources Relationelles');
					$mail->addAddress('simon.provost@ymail.com', $user->prenom);
 					$mail->Subject = 'Confirmation de compte';
   					$mail->Body = $message;

					// Envoyer l'e-mail
					$mail->send();
					echo json_encode(array("status"=>"success","code"=>"0001","message"=>"Account created"));
				} catch (Exception $e) {
					echo json_encode(array("status"=>"error","code"=>"0099","message"=>"Error while inserting into database"));
				}
			}else{
				echo json_encode(array("status"=>"error","code"=>"0099","message"=>"Error while inserting into database"));
			}
		}
		
		public function getInfos($mail){
			$user = $this->UserManager->getByMail($mail);
			$user->likes = $this->LikesManager->getUserLikes($user->id);
			echo json_encode($user);
		}


		public function getProfilePicture($path){
			echo (file_get_contents($path));
		}


		public function ConfirmAccount($mail,$code){
			$result = $this->UserManager->confirmAccount($mail,$code);
		}

		public function InviteUser($aliasSender,$aliasReceiver){
			$result = $this->UserManager->InviteUser($aliasSender,$aliasReceiver);
		}

	}