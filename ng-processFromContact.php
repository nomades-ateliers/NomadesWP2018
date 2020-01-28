<?php 
 header('Access-Control-Allow-Origin: *');  
 header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
 header('Access-Control-Allow-Headers: Origin, Content-Type, cache-control, X-Auth-Token');
//_________________________________________________
//_____________________________ GESTION ET SECURISATIONS DES SESSIONS
//_________________________________________________
session_start();
$data = json_decode(file_get_contents('php://input'), true);
$success = false;
// check confirmation
if (isset($_POST['email_confirmation']) && $_POST['email_confirmation'].count() > 0) {
  echo '{"result": 400, "message": "page not found"}';
}
// check personal captcha
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
    require_once('../lib/PHPMailer/class.phpmailer.php');
    require_once('../mailtype/carapace-contact.php');

    $mail = new PHPMailer();
    $headers = "From: " . $nom . " <" . $email . ">";
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->IsHTML(true);
    $mail->SetFrom("info@nomades.ch","Ateliers Nomades");
    
    $mail->Host = "mail.infomaniak.com"; // SMTP server
    $mail->Username = "natacha.aka@nomades.ch"; 
    $mail->Password = "q9*0tzXdT?j0OO1O2kké"; 
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;

    $mail->AddAddress('info@nomades.ch');
    if (isset($data['copy'])) {
      $mail->AddBCC($data['email'], $data['nom']);
    }

    $mail->Subject  = 'Message de contact';
    $mail->Body     = $contenuDuMessage;
    $mail->WordWrap = 50;
    $success = $mail->Send();
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) || isset($data["ajax"]) ) {
  //echo $TEST_ROBOT;
  echo $success ? '{"result": 200, "message": "success send by ajax"}' : '{"result": 400, "message": "'.$mail->ErrorInfo.'"}';
} else {
  echo '{"result": 400, "message": "page not found"}';
}

?>


