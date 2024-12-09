<?php

function sendRegEmail($email,$openPassword){
    $to  = "$email";
    $subject = "Anmeldung";
    $message = " <p>Vielen Dank für die Registrierung auf dem Server</p>";
    $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
    //$headers .= "From:<support@smmnakrutka.ru>\r\n"; 
    $headers .= "Reply-To: reply-to@example.com\r\n"; 
    mail($to, $subject, $message, $headers); 
}

function sendResetPasswordEmail($email, $resetpassword){
    $to  = "$email";
    $subject = "Passwort zurücksetzen";
    $message = " <p>Zurücksetzen Ihres Passworts auf dem Server</p>  </br> <p>Dein Code:</p> <b>$resetpassword</b>";
    $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
    //$headers .= "From:<support@smmnakrutka.ru>\r\n"; 
    $headers .= "Reply-To: reply-to@example.com\r\n"; 
    mail($to, $subject, $message, $headers); 
}

//sendResetPasswordEmail('ermak80_pass@mail.ru','12345678');


?>