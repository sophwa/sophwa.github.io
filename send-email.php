<?php

$name = $_POST["name"]; 
$email = $_POST["email"]; 
$message = $_POST["message"]; 

require "vendor/autoload.php"; 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$email_username = getenv('EMAIL_USERNAME');
$email_password = getenv('EMAIL_PASSWORD');

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 

$mail = new PHPMailer(true); 

try {
    //Server Settings
    $mail->SMTPAuth = true;
    $mail-> Host = "smtp.gmail.com"; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = $email_username;
    $mail->Password = $email_password;

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress("slw284@cornell.edu");

    //Content
    $mail->Subject = "A Message from Personal Website";
    $mail->Body = $message;

    $mail->send(); 
    echo("Message has been sent!"); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}