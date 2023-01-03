<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// load the PHPmailer class files directly
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions for debug
$mail = new PHPMailer(false);

try {
    // variables
    $from = 'support@venture-idea.com';
    $to = $_POST['email'];
    $message = $_POST['url'];

    // PHPmailer setup
    $mail = new PHPMailer();
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // dev only for debug
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.ionos.de';
    $mail->Port = 587;
    $mail->Username = $from;
    $mail->Password = 'venture-idea!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // recipients
    $mail->setFrom($from);
    $mail->addAddress($to);

    // content
    $mail->Subject = 'Download link';
    $mail->isHTML(false);
    $mail->Body = $message;

    $mail->send();
    //header("Location: https://www.XXXX/thanks");
    // echo 'Message has been sent'; // dev only
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>