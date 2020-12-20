<?php 
//php form for sending email via contact form

//start session
session_start();
//include
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'C:/xampp1/COMPOSER/vendor/autoload.php';

//get fields
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];

//mail
$mail = new PHPMailer();
try {
$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
$mail->IsSMTP(); 
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true; 
 //TO ENABLE ADD EMAIL AND PASSWORD
$mail->Username = 'youremail';                     
$mail->Password = 'yourpassword'; 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
$mail->Port = 587;

$mail->setFrom($email, $name);
$mail->AddReplyTo($email, $name);
$mail->addAddress('teozoumphs@gmail.com'); 
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);

$mail->isHTML(true);
$mail->Subject = 'Iris Contact Form';
$mail->Body = $subject;

$mail->send();  
} 
//errors
catch (Exception $e){}
              
?>
