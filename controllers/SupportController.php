<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

class SupportController extends BaseController
	{
        public function SendMail($name,$surname,$phoneNumber,$email,$reason){
            

            require 'assets/libraries/PHPMailer/src/PHPMailer.php';
            require 'assets/libraries/PHPMailer/src/SMTP.php';
            require 'assets/libraries/PHPMailer/src/Exception.php';

            $message = '<!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset="UTF-8">
                            <title>Confirmation mail au support</title>
                        </head>
                        <body>
                            <p>Bonjour '.$name.'</p>
                            <p>Nous vous confirmons votre envois de mail au support de (Re)Ssource Relationelle</p>
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
                $mail->addAddress('simon.provost@ymail.com', $name);
                $mail->Subject = 'Confirmation mail au support';
                $mail->Body = $message;

                // Envoyer l'e-mail
                $mail->send();
                //echo json_encode(array("status"=>"success","code"=>"0001","message"=>"Account created"));
            } catch (Exception $e) {
                //echo json_encode(array("status"=>"error","code"=>"0099","message"=>"Error while inserting into database"));
            }


              $message = '<!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset="UTF-8">
                        </head>
                        <body>
                            <p> Prenom nom de l\'utilisateur : '.$name.' '. $surname.'</p>
                            <p> Coordonnees : '.$phoneNumber.' '. $email.'</p>
                            <p> Message de l\'utilisateur : </p>
                            <p>'.$reason.'</p>
                        </body>
                        </html>';

                
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
                $mail->setFrom($email, "Utilisateur  (Re)ssources Relationelles");
                $mail->addAddress('simon.provost@ymail.com', $name);
                $mail->Subject = 'Support (Re)ssources Relationelles';
                $mail->Body = $message;

                // Envoyer l'e-mail
                $mail->send();
                echo json_encode(array("status"=>"success","code"=>"0001","message"=>"Account created"));
            } catch (Exception $e) {
                echo json_encode(array("status"=>"error","code"=>"0099","message"=>"Error while inserting into database"));
            }



            var_dump($reason,$email,$phoneNumber,$surname,$name);
        }


    }