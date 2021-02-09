<?php
require 'autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/SMTP.php';
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 2;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "TLS";
$mail->Port       = 465;
$mail->Host       = "mail.starxdev.com";
$mail->Username   = "mail@starxdev.com";
$mail->Password   = "1234Kambing";
$mail->IsHTML(true);
$mail->AddAddress("nizamhiga@gmail.com", "Comet Admin");
$content = "<b>A new project has been registered and need to be authorized.</b>";
$mail->SetFrom("admin@comet.com", "Comet Admin");
$mail->Subject = "COMET";
$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
  echo $_POST['registeredby'];
}
echo "<script> return sent;</script>";
?>