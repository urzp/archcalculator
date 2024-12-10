<?php

//https://hosting209012.ae957.netcup.net/php/dataServis/04_users/sendEmails.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require $_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPMailer-master/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPMailer-master/src/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPMailer-master/src/Exception.php';


$mail = new PHPMailer(true);

function configMail(){
    global $mail;
   //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  
   $mail->isSMTP();                                            //Send using SMTP
   $mail->Host       = 'mxe959.netcup.net';//'ssl://smtp.beget.com';                     //Set the SMTP server to send through
   $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
   $mail->Username   = 'mail@honorar.online';                     //SMTP username
   $mail->Password   = 'gY9@oc436';                               //SMTP password
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
   $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   $mail->setFrom('mail@honorar.online');
}

function sendResetPasswordEmail($email, $resetpassword){

    try {
        global $mail;
        configMail();
        $mail->addAddress($email);             
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset password';
        $mail->Body    = "The reset code is <b>$resetpassword</b>";
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

function sendRegistrationEmail($email, $password, $comfirmecode){

    try {
        global $mail;
        configMail();
        $mail->addAddress($email);             
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Herzlich willkommen auf der Website honorar.online!';
        $mail->Body    = "<h3>Herzlich willkommen auf der Website honorar.online!</h3>
                            <p>Sie haben sich erfolgreich bei uns registriert. Verwenden Sie die folgenden Daten, um sich in Ihr Konto einzuloggen:</p>
                            <p><b>Benutzername:</b> $email</p>
                            <p><b>Passwort:</b> $password</p>
                            <p>Um Ihre E-Mail zu bestätigen und die Registrierung abzuschließen, klicken Sie bitte auf folgenden Link: <a href='https://honorar.online?email=$email&code=$comfirmecode'>comfirm Email</a></p>
                            <p>Mit freundlichen Grüßen, das Team von honorar.online.</p>";
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}


?>