<?php
require '/var/www/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com;smtp.gmail.com'; 		  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'sylkaserver@gmail.com';            // SMTP username
$mail->Password = 'sylka1234';                        // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'sy1@sylka.example.com';
$mail->FromName = 'Server';
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress('cesarlopezcortes@me.com');           // Name is optional
$mail->addAddress('ventas@sylka.com.mx');
$mail->addAddress('sceballos@sylka.com.mx');
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Prueba desde Servidor...';
$mail->Body    = 'Prueba Servidor SMTP <b>desde sylka.ddns.net</b>';
$mail->AltBody = 'Prueba de texto plano para non-HTML Handlers';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>