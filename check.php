<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
include('server.php');


$sql = "SELECT * FROM projects";
if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $row['nama_projek'];
			$row['tarikh_mula'];
			$row['tarikh_tamat'];
			$row['penarafan'];
			$row['status'];
				if($row['sixmnth'] < strtotime("now") ){
					
					$mail = new PHPMailer;
					$mail->IsSMTP();
					$mail->Mailer = "smtp";
					$mail->SMTPDebug  = 1;  
					$mail->SMTPAuth   = TRUE;
					$mail->SMTPSecure = "tls";
					$mail->Port       = 587;
					$mail->Host       = "smtp.gmail.com";
					$mail->Username   = "nizam.yuseri@gmail.com";
					$mail->Password   = "nizamhiga";
					$mail->IsHTML(true);
					$mail->AddAddress($row['registeredby'], "Comet User");
					$content = "<b>Please send an update of your project in the comet system</b>";
					$mail->SetFrom("admin@comet.com", "Comet Admin");
					$mail->Subject = "COMET";
					
					$mail->MsgHTML($content);
					
					if(!$mail->Send()) {
					echo "Error while sending Email.";
					var_dump($mail);
					} else {
					echo "Email sent successfully";
					echo $row['registeredby'];
					var_dump($mail);
					
					}
					
				} else {
					echo $row['sixmnth']."<br>";
					echo strtotime('now');
				}
		}
    }
    // Free result set
    mysqli_free_result($result);
}
?>