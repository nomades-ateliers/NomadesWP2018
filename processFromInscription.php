<?php
//_________________________________________________
  //_____________________________ GESTION ET SECURISATIONS DES SESSIONS
  //_________________________________________________
  session_start();

// Define some constants
define( "RECIPIENT_NAME", "Ateliers Nomades" );
define( "RECIPIENT_EMAIL", "info@natiw.ch" );
define( "EMAIL_SUBJECT", "Pré-inscription depuis le site nomade" );


$response = $_POST["g-recaptcha-response"];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
  'secret' => '6LeAHWEUAAAAACrrris7tyX37kNO1ZW45QkfaXYZ',
  'response' => $_POST["g-recaptcha-response"]
);
$options = array(
  'http' => array (
    'method' => 'POST',
    'content' => http_build_query($data)
  )
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success=json_decode($verify);
if ($captcha_success->success==false) {
  
} else if ($captcha_success->success==true) {


// Read the form values
$success = false;

$prenom = isset( $_POST['prenom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['prenom'] ) : "";

$nom = isset( $_POST['nom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['nom'] ) : "";


$naissance = isset( $_POST['naissance'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['naissance'] ) : "";

$profession = isset( $_POST['profession'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['profession'] ) : "";

$cp = isset( $_POST['cp'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['cp'] ) : "";

$email = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";

$adresse = isset( $_POST['adresse'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['adresse'] ) : "";

$message = isset( $_POST['message_pre_inscription'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message_pre_inscription'] ) : "";

$recevoir_copie = isset( $_POST['recevoir_copie'] ) ? "OUI" : "NON";

$workshop = '<table style="WIDTH:510px;font-size:12px;BORDER-COLLAPSE: collapse;MARGIN-TOP:10px;MARGIN-LEFT:20px;MARGIN-RIGHT:20px;MARGIN-BOTTOM:5px;"><tr><td style="PADDING:5px;PADDING-LEFT:0PX;font-weight:bold;">Titre</td><td style="PADDING:5px;font-weight:bold;">Date</td><td style="PADDING:5px;font-weight:bold;">Prix</td></tr>';

for ($i=1; $i < 6; $i++) { 
  # code...
  if (isset($_POST['workshop_'.$i]) and $_POST['workshop_'.$i] != ""){
  $workshop .= '<tr><td style="PADDING:5px;PADDING-LEFT:0PX;border-bottom:1px solid #666;">'.$_POST['workshop_'.$i].' </td><td style="PADDING:5px;border-bottom:1px solid #666;"> '.$_POST['date_select_'.$i].'</td><td style="PADDING:5px;color:#c33a32;border-bottom:1px solid #666;">CHF '.$_SESSION['workshop_'.$i].'</td></tr>';
  }

}

$workshop .= '</table>';

$workshop .= '<p style="text-align:left;line-height:20px;font-family:arial;text-align:justify;color:#2D2D2D;font-size:14px;margin-top:5px;margin-left:20px;margin-right:20px;margin-bottom:20px;background:#fff;color:#726A5D;padding:10px;">Prix total des workshops : <span style="color:#c33a32">CHF '.$_SESSION['total_workshop'].'</span></p>';





// Champs obligatoires existe, on envoie le message
if ( $prenom && $nom && $email) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $nom . " <" . $email . ">";
 // $success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );


  require_once('../lib/PHPMailer/class.phpmailer.php');
  $mail = new PHPMailer();

  require_once('../mailtype/carapace-pre-inscription.php');
  $mail->CharSet = 'UTF-8';
 
  $mail->IsSMTP();  // telling the class to use SMTP
  $mail->IsHTML(true);

 
  $mail->SMTPAuth = true;
  $mail->SMTPDebug = 0;
  $mail->Host = "mail.infomaniak.com"; // SMTP server
  $mail->Username = "info@nomades.ch"; 
  $mail->Password = "foh1OhY5me"; 


  $mail->SetFrom("info@nomades.ch","Ateliers nomades");

  $mail->AddAddress(RECIPIENT_EMAIL);
 
  $mail->AddBCC('contact@pm-vial.com', 'Pierre-Marie vial');
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
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : $mail->ErrorInfo;
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

}
?>


