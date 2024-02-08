<?php

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

$name = $_POST["name"];
$email = $_POST["email"];
$body = $_POST["body"];

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = ' ';
$mail->Password = ' ';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
try {
    $mail->setFrom('', 'PHP Mailer');
    $mail->addReplyTo(' ', 'PHP Mailer');
    $mail->addAddress($email, $name);
    $mail->isHTML();
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo $e;
}
$mail->Subject = ' ';
ob_start();
include('mail.php');
$mail->Body = ob_get_clean();

try {
    if (!$mail->send()) {
        echo "Verification Code sending fail";
    } else {
        echo 'Success';
    }
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo "Failed";
}