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
//  echo '{result: 400, message: "captcha error", stack: '.$verify.'}';
// //  echo '{}';
// } else if ($captcha_success->success==true) {


// Read the form values
$success = false;
if (isset($data['email_confirmation']) && $data['email_confirmation'].count() > 0) {
  echo '{"result": 400, "message": "page not found"}';
}
if (isset($data['captcha']) && $data['captcha'] !== 'nomades') {
  echo '{"result": 400, "message": "page not found"}';
}

$prenom = isset( $data['prenom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['prenom'] ) : "";
$nom = isset( $data['nom'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['nom'] ) : "";
$phone = isset( $data['phone'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $data['phone'] ) : "";
$email = isset( $data['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $data['email'] ) : "";
$message = isset( $data['message_pre_inscription'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $data['message_pre_inscription'] ) : "";
$recevoir_copie = isset( $data['recevoir_copie'] ) ? "OUI" : "NON";
$formations = '<table style="WIDTH:510px;font-size:12px;BORDER-COLLAPSE: collapse;MARGIN-TOP:10px;MARGIN-LEFT:20px;MARGIN-RIGHT:20px;MARGIN-BOTTOM:5px;"><tr><td style="PADDING:5px;PADDING-LEFT:0PX;font-weight:bold;">Titre</td><td style="PADDING:5px;font-weight:bold;">Date</td><td style="PADDING:5px;font-weight:bold;">Prix</td></tr>';

foreach ($data['formations'] as $fm) {
  $formations .= '<tr><td style="PADDING:5px;PADDING-LEFT:0PX;border-bottom:1px solid #666;">'.$fm['name'].' </td><td style="PADDING:5px;border-bottom:1px solid #666;"> '.$fm['date'].'</td><td style="PADDING:5px;color:#c33a32;border-bottom:1px solid #666;">CHF '.$fm['price'].'</td></tr>';
}

$formations .= '</table>';

// Champs obligatoires existe, on envoie le message
if (($prenom && $nom && $email)) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $nom . " <" . $email . ">";
  // $success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );

  require_once('../lib/PHPMailer/class.phpmailer.php');
  $mail = new PHPMailer();

  // require_once('../mailtype/carapace-pre-inscription.php');

  $contenuDuMessage = '
  <BODY style="TEXT-ALIGN: center; BACKGROUND-COLOR:#FFF;">
  <TABLE 
  style="PADDING-RIGHT: 0px; BORDER:0px; background-color:#FFF;PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px auto; VERTICAL-ALIGN: top; WIDTH: 550px; PADDING-TOP: 0px; FONT-FAMILY: arial, Arial; BORDER-COLLAPSE: collapse">
    <TBODY>
    <TR style="border:none;width:550px;">
      <TD style="background:#FFF;text-align:center;vertical-align:top;border:none;padding:0px;padding-bottom:10px">
        <IMG  alt="logo orpi" SRC="http://www.nomades.ch/mailtype/images/logo-nomades-mail.jpg" STYLE="BORDER:NONE;" height="96" width="550"/>
    </TD>
    </TR>
    <TR style="background:#FBFBFB;vertical-align:top;border:none;padding:0px">
      <TD style="vertical-align:top;border:none;padding:0px;border-bottom:1px dashed #BBB0AA">
        <p style="font-weight:bold;line-height:15px;font-family:arial;color:#c33a32;font-size:16px;margin-top:10px;margin-left:0px;margin-right:0px;margin-bottom:30px;text-align:center;margin-top:2Opx">Message de pré-inscription</p>
        <p style="text-align:left;line-height:15px;font-family:arial;color:#c33a32;font-size:14px;margin-top:10px;margin-left:20px;margin-right:0px;margin-bottom:10px">Retrouvez les informations de l\'utilisateur ci-dessous :</p>
        <p style="text-align:left;line-height:20px;font-family:arial;text-align:justify;color:#2D2D2D;font-size:14px;margin-top:10px;margin-left:20px;margin-right:20px;margin-bottom:20px">
          Prénom : <span style="font-weight:bold">'.$prenom.'</span> <br />
          Nom : <span style="font-weight:bold">'.$nom.'</span> <br />
          Email : <span style="font-weight:bold">'.$email.'</span> <br />
          Telephone : <span style="font-weight:bold">'.$phone.'</span> <br />
        </p>
        <p style="text-align:left;line-height:20px;font-family:arial;text-align:justify;color:#2D2D2D;font-size:14px;margin-top:10px;margin-left:20px;margin-right:20px;margin-bottom:15px">
          Message de l\'utilsateur : <br /><span style="font-weight:bold;font-size:12px;">'.$message.'</span></p>
        <p style="text-align:left;line-height:15px;font-family:arial;color:#c33a32;font-size:14px;margin-top:10px;margin-left:20px;margin-right:0px;margin-bottom:0px;font-weight:bold;">Pré-inscription pour les formations suivants :</p>
        '.$formations.'
      </TD>
    </TR>
    <TR style="background:#FBFBFB;vertical-align:top;padding:0px;border-top:none">
      <TD style="vertical-align:top;border:none;padding:0px;">
        <p style="text-align:center;line-height:15px;font-family:arial;text-align:center;color:#C33A32;font-size:12px;margin-top:10px;margin-left:0px;margin-right:0px;margin-bottom:10px;background:#FBFBFB;color:#C33A32">Message automatique depuis le site NOMADES.CH</p>
      </TD>
    </TR>
  </TBODY></TABLE></BODY>';

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
  //  $mail->AddAddress(RECIPIENT_EMAIL);
   $mail->AddAddress('nicolas@nomades.ch');
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
      $mail_copie->Subject  = 'Copie du mail : Pré-inscription aux formations depuis le site nomade';
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


