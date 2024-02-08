<?php

session_start();

require "model/Connection.php";

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($name)) {
        echo "Name not Found";
    } else if (empty($email)) {
        echo "Email not Found";
    } else if (empty($password)) {
        echo "Password not Found";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email";
    } else if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s]).{8,20}$/", $password)) {
        echo "Invalid Password";
    } else {

        $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
        $row = $resultset->num_rows;
        if ($row != 0) {
            echo "This email already exist";
        } else {

            $dateTime = new DateTime();
            $dateTimeZone = new DateTimeZone("Asia/colombo");
            $dateTime->setTimezone($dateTimeZone);
            $nowDateTime = $dateTime->format('Y-m-d H:i:s');
            
            $verificationCode = uniqid();

            Database::iud("INSERT INTO `user`(`name`,`email`,`password`,`verification_code`,`created_at`,`updated_at`,`status`) 
            VALUES('" . $name . "','" . $email . "','" . $password . "','".$verificationCode."','".$nowDateTime."','".$nowDateTime."','1')");
            
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'abdurrahman200418@gmail.com';
            $mail->Password = 'oisqywnreppbyzzf';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            try {
                $mail->setFrom('abdurrahman200418@gmail.com', 'Final Project');
                $mail->addReplyTo('abdurrahman200418@gmail.com', 'Final Project');
                $mail->addAddress($email, $name);
                $mail->isHTML();
            } catch (\PHPMailer\PHPMailer\Exception $e) { 
                echo $e;
            }
            $mail->Subject = 'Final Project Email Verification';
            $mail->Body = '<h1 style="color: red;">Your Email Verification Code is : ' . $verificationCode . '</h1>';

            try {
                if (!$mail->send()) {
                    echo "Verification Code sending fail";
                } else {
                    echo 'Success';
                }
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                echo "Failed";
            }
        }


    }
}
?>