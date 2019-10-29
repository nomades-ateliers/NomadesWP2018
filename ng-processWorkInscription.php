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
define( "EMAIL_SUBJECT", "Pré-inscription depuis le site nomade" );


$data = json_decode(file_get_contents('php://input'), true);
$success = false;
if (isset($data['email_confirmation']) && $data['email_confirmation'].count() > 0) {
  echo '{"result": 400, "message": "page not found"}';
}
if (isset($data['captcha']) && $data['captcha'] !== 'nomades') {
  echo '{"result": 400, "message": "page not found"}';
}

$prenom = isset( $data['prenom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['prenom'] ) : "";

$nom = isset( $data['nom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['nom'] ) : "";


$naissance = isset( $data['naissance'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['naissance'] ) : "";

$profession = isset( $data['profession'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['profession'] ) : "";

$cp = isset( $data['cp'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['cp'] ) : "";

$email = isset( $data['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $data['email'] ) : "";

$adresse = isset( $data['adresse'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $data['adresse'] ) : "";

$message = isset( $data['message_pre_inscription'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $data['message_pre_inscription'] ) : "";

$recevoir_copie = isset( $data['recevoir_copie'] ) ? "OUI" : "NON";

$workshop = '<table style="WIDTH:510px;font-size:12px;BORDER-COLLAPSE: collapse;MARGIN-TOP:10px;MARGIN-LEFT:20px;MARGIN-RIGHT:20px;MARGIN-BOTTOM:5px;"><tr><td style="PADDING:5px;PADDING-LEFT:0PX;font-weight:bold;">Titre</td><td style="PADDING:5px;font-weight:bold;">Date</td><td style="PADDING:5px;font-weight:bold;">Prix</td></tr>';

// for ($i=1; $i < 6; $i++) { 
//   # code...
//   if (isset($data['workshops'][$i]) and $data['workshops'][$i] != ""){
//   $workshop .= '<tr><td style="PADDING:5px;PADDING-LEFT:0PX;border-bottom:1px solid #666;">'.$data['workshops'][$i].' </td><td style="PADDING:5px;border-bottom:1px solid #666;"> '.$data['workshops'][$i]->date_session_1_du.' au '.$data['workshops'][$i]->date_session_1_au.'</td><td style="PADDING:5px;color:#c33a32;border-bottom:1px solid #666;">CHF '.$data['workshops'][$i]->ecolage_wk.'</td></tr>';
//   }

// }

foreach ($data['workshops'] as $wk) {
  $workshop .= '<tr><td style="PADDING:5px;PADDING-LEFT:0PX;border-bottom:1px solid #666;">'.$wk['title']['rendered'].' </td><td style="PADDING:5px;border-bottom:1px solid #666;"> '.$wk['date_session_1_du'].' au '.$wk['date_session_1_au'].'</td><td style="PADDING:5px;color:#c33a32;border-bottom:1px solid #666;">CHF '.$wk['ecolage_wk'].'</td></tr>';
}

$workshop .= '</table>';

$workshop .= '<p style="text-align:left;line-height:20px;font-family:arial;text-align:justify;color:#2D2D2D;font-size:14px;margin-top:5px;margin-left:20px;margin-right:20px;margin-bottom:20px;background:#fff;color:#726A5D;padding:10px;">Prix total des workshops : <span style="color:#c33a32">CHF '.$data['total_workshop'].'</span></p>';





// Champs obligatoires existe, on envoie le message
if (($prenom && $nom && $email)) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $nom . " <" . $email . ">";
 // $success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );


  require_once('../lib/PHPMailer/class.phpmailer.php');
  $mail = new PHPMailer();

  require_once('../mailtype/carapace-pre-inscription.php');
  $mail->CharSet = 'UTF-8';
 
	$mail->SetFrom("info@nomades.ch","Ateliers Nomades");
  $mail->IsSMTP();  // telling the class to use SMTP
  $mail->IsHTML(true);

 
  $mail->SMTPAuth = true;
  $mail->SMTPDebug = 0;
	$mail->Host = "mail.infomaniak.com"; // SMTP server
	$mail->Username = "info@nomades.ch"; 
	$mail->Password = "foh1OhY5me"; 


  // $mail->AddAddress(RECIPIENT_EMAIL);
   $mail->AddAddress(RECIPIENT_EMAIL);
   // $mail->AddAddress('nicolas@nomades.ch');
  // $mail->AddBCC('contact@pm-vial.com', 'Pierre-Marie vial');
  //$mail->AddBCC('damien@levelstudio.ch', 'Damien');

  $mail->Subject  = EMAIL_SUBJECT;
  $mail->Body     = $contenuDuMessage;
  $mail->WordWrap = 50;

  $success = $mail->Send();

  if($success and $recevoir_copie == 'OUI'){

      $mail_copie = new PHPMailer();
      require_once('../mailtype/carapace-pre-inscription.php');
      $mail_copie->CharSet = 'UTF-8';
      $mail_copie->IsSMTP();  // telling the class to use SMTP
      $mail_copie->IsHTML(true);
      $mail_copie->SMTPAuth = true;
      $mail_copie->SMTPDebug = 0;
      $mail_copie->Host = "mail.infomaniak.com"; // SMTP server
      $mail_copie->Username = "info@nomades.ch"; 
      $mail_copie->Password = "foh1OhY5me"; 
      $mail_copie->SetFrom("info@nomades.ch","Ateliers nomades");
      $mail_copie->AddAddress($email);
      $mail_copie->Subject  = 'Copie du mail : Pré-inscription depuis le site nomade';
      $mail_copie->Body     = $contenuDuMessage;
      $mail_copie->WordWrap = 50;
      $success = $mail_copie->Send();

  }
 
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


