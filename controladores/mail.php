<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

echo 'PHP version: ' . phpversion();
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
//$mail->isSMTP(); //or $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
$mail->Timeout=60;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'notificaciones.energia.ruitoque@gmail.com';   //email
$mail->Password = 'deplaoawwkpfwcgs';

//Set who the message is to be sent from
$mail->setFrom('notificaciones.energia.ruitoque@gmail.com', 'Nombre');

//Set an alternative reply-to address
$mail->addReplyTo('notificaciones.energia.ruitoque@gmail.com', 'Nombre');

//Set who the message is to be sent to
$mail->addAddress('oscar.2001601@gmail.com', 'Usuario :');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';

//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

$mail->Body = '<h1>This is a plain-text message body</h1> Lorem ipsum dolor sit amet, consectetur.';

$mail->IsHTML(true);

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
															
													
