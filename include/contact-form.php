<?php 
//////////////////////////
//Specify default values//
//////////////////////////
/*
//Your E-mail

$your_email = 'your@email.net';

//Default Subject if 'subject' field not specified
$default_subject = 'From My Contact Form';

//Message if 'name' field not specified
$name_not_specified = 'Please type a valid name';

//Message if 'message' field not specified
$message_not_specified = 'Please type a vaild message';

//Message if e-mail sent successfully
$email_was_sent = 'Send message complete!';

//Message if e-mail not sent (server not configured)
$server_not_configured = 'Sorry, mail server not configured';


///////////////////////////
//Contact Form Processing//
///////////////////////////
$errors = array();
if(isset($_POST['message']) and isset($_POST['name'])) {
	if(!empty($_POST['name']))
		$sender_name  = stripslashes(strip_tags(trim($_POST['name'])));
	
	if(!empty($_POST['message']))
		$message      = stripslashes(strip_tags(trim($_POST['message'])));
	
	if(!empty($_POST['email']))
		$sender_email = stripslashes(strip_tags(trim($_POST['email'])));
	
	if(!empty($_POST['subject']))
		$subject      = stripslashes(strip_tags(trim($_POST['subject'])));


	//Message if no sender name was specified
	if(empty($sender_name)) {
		$errors[] = $name_not_specified;
	}

	//Message if no message was specified
	if(empty($message)) {
		$errors[] = $message_not_specified;
	}

	$from = (!empty($sender_email)) ? 'From: '.$sender_email : '';

	$subject = (!empty($subject)) ? $subject : $default_subject;

	//$message = (!empty($message)) ? wordwrap($message, 70) : '';

	$message = "	Nom: $sender_name 

	E-mail: $sender_email 

	Message: $message

	";


	//sending message if no errors
	if(empty($errors)) {
		if (mail($your_email, $subject, $message, $from)) {
			echo $email_was_sent;
		} else {
			$errors[] = $server_not_configured;
			echo implode('<br>', $errors );
		}
	} else {
		echo implode('<br>', $errors );
	}
} else {
	// if "name" or "message" vars not send ('name' attribute of contact form input fields was changed)
	echo '"name" and "message" variables were not received by server. Please check "name" attributes for your input fields';
}*/

// Reporte toutes les erreurs PHP
error_reporting(-1);

//require_once (__DIR__.'/libs/class.phpmailer.php');
require 'PHPMailerAutoload.php';
$er = "";
$success = "";

// Check if the web form has been submitted
if (isset($_POST["contact_form"])){

	/*
	 * Process the web form variables
	 * Strip out any malicious attempts at code injection, just to be safe.
	 * All that is stored is safe html entities of code that might be submitted.
	 */
	$contactName = htmlentities(substr($_POST["name"], 0, 100), ENT_QUOTES);
	$contactEmail = htmlentities(substr($_POST["email"], 0, 100), ENT_QUOTES);	
	$messageContent = htmlentities(substr($_POST["message"], 0, 10000), ENT_QUOTES);
	
	/*
	 * Perform some logic on the form data
	 * If the form data has been entered incorrectly, return an Error Message
	 */

	 // Check if the data entered for the E-mail is formatted like an E-mail should be
	if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
		//Please enter a valid e-mail address.
		$er .= 'Bitte geben Sie eine gültige E-Mail-Adresse ein.<br />';
	}

	// Check if all of the form fields contain data before we allow it to be submitted successfully
	if ($contactName == "" || $contactEmail == "" ||  $messageContent == ""){
		//Your Name, E-mail, Message Subject, and Message Content cannot be left blank.<br />
		$er .= "Ihr Name, E-Mail, Betreff und Nachricht Inhalt kann nicht leer sein. <br />";
	}
	
	// IF NO ERROR - START
	if ($er == ''){

		// Prepare the E-mail elements to be sent
		try {
			$mail = new PHPMailer(true); //New instance, with exceptions enabled
			// : A Contact Message
			$message =
					'<html>
						<head>
						<title>Figetec Maroc - Formulaire contact</title>
						</head>
						.<body>
						' . wordwrap($messageContent, 100) . '
						</body>
					</html>';
			$message             = preg_replace('/\\\\/','', $message); //Strip backslashes
		
			$mail->IsSMTP();                           // tell the class to use SMTP
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = 'ssl';
			$mail->Port       = 465;
			$mail->Host       = "ns0.ovh.net"; // SMTP server
			$mail->Username = "formulaire-contact@frigetecmaroc.com";              // SMTP username
			$mail->Password = "frigetec2017";              // SMTP password
			
			//$mail->IsSendmail();  // tell the class to use Sendmail
			$mail->ReturnPath = $contactName . ' <' . $contactEmail . '>';
			$mail->AddReplyTo($contactEmail,$contactName);
		    $mail->Sender = $contactEmail;
			$mail->From       = $contactEmail;
			$mail->FromName   = $contactName . ' <' . $contactEmail . '>';
		
			// Ca doit être nassiri1994
			$to = "oussama.ezziouri@gmail.com";
		
			$mail->AddAddress($to);
		
			$mail->Subject  = 'Frigetec Maroc - Formulaire contact';
			//To view the message, please use an HTML compatible email viewer!
			$mail->AltBody    = "Pour voir le message, s'il vous plaît utiliser une visionneuse e-mail compatible HTML!"; // optional, comment out and test
			$mail->WordWrap   = 80; // set word wrap
		
			$mail->MsgHTML($message);
		
			$mail->IsHTML(true); // send as HTML
		
			$mail->Send();			
			//Thank you for contacting . We will read your message and contact you if necessary.
			$success = "Nous nous réjouissons de votre demande!";
			$success .= '<br /><br />';
			$success .= "Votre message a été envoyé, nous prendrons contact avec vous dans le plus bref délais.";
			$success .= '<br /><br />';
			$success .= "Si vous avez des questions, merci de nous contacter.";
			$success .= '<br /><br />';
			$success .= '<b>Téléphone : 06 61 96 42 80</b>'; 				
			$success .= '<br /><br />';
			$success .= '<b>Email : frigetecmaroc@gmail.com</b>'; 				
		} catch (phpmailerException $e) {
			echo $e->errorMessage();
			//We weren't able to send your message. Please contact 
			$er .= "Nous ne pouvons pas envoyer le message. S'il vous plaît contacter " . $to . '.<br />';
		}
	}
	// IF NO ERROR - END
}
			



?>
