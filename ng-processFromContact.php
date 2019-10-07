<?php 
 header('Access-Control-Allow-Origin: *');  
 header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
 header('Access-Control-Allow-Headers: Origin, Content-Type, cache-control, X-Auth-Token');
  //_________________________________________________
  //_____________________________ GESTION ET SECURISATIONS DES SESSIONS
  //_________________________________________________
  session_start();

// Define some constants
define( "RECIPIENT_NAME", "Ateliers Nomades" );
define( "RECIPIENT_EMAIL", "info@natiw.ch" );
define( "EMAIL_SUBJECT", "Message de contact" );

$data = json_decode(file_get_contents('php://input'), true);
// $url = 'https://www.google.com/recaptcha/api/siteverify';
// $captcha_data = array(
//   'secret' => '6LdZQnUUAAAAAJ8tx3b-ejHY0UKOFYkQOs5CWL_V',
//   'response' => $data["captcha"]
// );
// $options = array(
//   'http' => array (
//     'method' => 'POST',
//     'content' => http_build_query($captcha_data)
//   )
// );
// $context  = stream_context_create($options);
// $verify = file_get_contents($url, false, $context);
// $captcha_success=json_decode($verify);
// if ($captcha_success->success==false) {
//  //  echo '{result: 400, message: '.$verify.'}';
//  echo '{}';
// } else if ($captcha_success->success==true) {

// // Read the form values
// $success = false;
$success = false;
if (isset($_POST['email_confirmation']) && $_POST['email_confirmation'].count() > 0) {
  echo '{"result": 400, "message": "page not found"}';
}
if (isset($_POST['captcha']) && $_POST['captcha'] !== 'nomades') {
  echo '{"result": 400, "message": "page not found"}';
}


$prenom = isset( $data['prenom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['prenom'] ) : "";

$nom = isset( $data['nom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['nom'] ) : "";

$email = isset( $data['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $data['email'] ) : "";

$objet = isset( $data['objet'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $data['objet'] ) : "";

$message = isset( $data['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $data['message'] ) : "";

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
    if (isset($data['copy'])) {
      $mail->AddBCC($data['email'], $data['nom']);
    }
    // $mail->AddAddress('nicolas@nomades.ch');
    //$mail->AddBCC('contact@pm-vial.com', 'Pierre-Marie vial');
    //$mail->AddBCC('damien@levelstudio.ch', 'Damien');
    //$mail->AddBCC('fazio@nicolasfazio.ch', 'Fazio');
  

    $mail->Subject  = EMAIL_SUBJECT;
    $mail->Body     = $contenuDuMessage;
    $mail->WordWrap = 50;

    $success = $mail->Send();


 
}


// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) || isset($data["ajax"]) ) {
  //echo $TEST_ROBOT;
  echo $success ? '{"result": 200, "message": "success send by ajax"}' : '{"result": 400, "message": '.$mail->ErrorInfo.'}';
} else {
  echo '{"result": 400, "message": "page not found"}';

}

// }
?>


