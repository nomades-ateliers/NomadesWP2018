<?php 
  //_________________________________________________
  //_____________________________ GESTION ET SECURISATIONS DES SESSIONS
  //_________________________________________________
  session_start();

// Define some constants
define( "RECIPIENT_NAME", "Ateliers Nomades" );
define( "RECIPIENT_EMAIL", "info@nomades.ch" );
define( "EMAIL_SUBJECT", "Message de contact" );

$success = false;
if (isset($_POST['email_confirmation']) && $_POST['email_confirmation'].count() > 0) {
  echo '{"result": 400, "message": "page not found"}';
}
if (isset($_POST['captcha']) && $_POST['captcha'] !== 'nomades') {
  echo '{"result": 400, "message": "page not found"}';
}

$prenom = isset( $_POST['prenom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['prenom'] ) : "";

$nom = isset( $_POST['nom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['nom'] ) : "";

$email = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";

$objet = isset( $_POST['objet'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['objet'] ) : "";

$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// Champs obligatoires existe, on envoie le message
if (($prenom && $nom && $email)) {


    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $headers = "From: " . $nom . " <" . $email . ">";
   // $success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );


    require_once('../lib/PHPMailer/class.phpmailer.php');
    $mail = new PHPMailer();

    require_once('../mailtype/carapace-contact.php');
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->IsHTML(true);
    
  // HOST PM
 // $mail->SMTPAuth = true;
 // $mail->Host     = "auth.smtp.1and1.fr"; // SMTP server
 // $mail->Username = "contact@pm-vial.com"; 
 // $mail->Password = "weedjet"; 


  // Ancient avant migration sur infomaniak
  // $mail->Username = "info@natiw.ch"; 
  // $mail->Password = "12345";  
  // $mail->SetFrom("info@natiw.ch","Ateliers Nomades");


	$mail->SetFrom("info@nomades.ch","Ateliers Nomades");
	$mail->SMTPAuth = true;
	$mail->SMTPDebug = 0;


   // $mail->Host = 'nova.nomades.ch';
   // $mail->SMTPSecure = 'ssl';
   // $mail->SMTPAuth = true;

   // $mail->SMTPDebug = 1;
   // $mail->Host     = "nova.nomades.ch"; // SMTP server
    //$mail->Host     = "192.168.1.2"; // SMTP server
   // $mail->Username = "info@nomades.ch"; 
   // $mail->Password = "0g57CBMa";  
   //  $mail->Password = "WpA7iwrG"; 
   
	// Bof - Connexion depuis smtp Infomaniak
	//$mail->Host = "192.168.1.2"; // SMTP server
	$mail->Host = "mail.infomaniak.com"; // SMTP server
	$mail->Username = "info@nomades.ch"; 
	$mail->Password = "foh1OhY5me"; 
	// End

   //$mail->SetFrom("info@natiw.ch","Ateliers nomades");
   // $mail->AddAddress('damien@levelstudio.ch');
    
    $mail->AddAddress('info@nomades.ch');
    //$mail->AddAddress('nicolas@nomades.ch');
    // $mail->AddBCC('contact@pm-vial.com', 'Pierre-Marie vial');
    //$mail->AddBCC('damien@levelstudio.ch', 'Damien');
    //$mail->AddBCC('fazio@nicolasfazio.ch', 'Fazio');
  

    $mail->Subject  = EMAIL_SUBJECT;
    $mail->Body     = $contenuDuMessage;
    $mail->WordWrap = 50;

    if($mail->Send()) $success = 'success';
 


 
 } else{
  $success = 'pb';
 }


// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) || isset($data["ajax"]) ) {
  //echo $TEST_ROBOT;
    echo $success;
} else {
?>
<html>
  <head>
    <title>Thanks!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Thanks for sending your message! We'll get back to you shortly.</p>" ?>
  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again.</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}

// }
?>