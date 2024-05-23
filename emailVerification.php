<?php

require "model/Connection.php";

if (isset($_POST["email"]) && isset($_POST["verificationCode"])) {
    $email = $_POST["email"];
    $verificationCode = $_POST["verificationCode"];

    if (empty($email)) {
        echo "Email not Found";
    }else if (empty($verificationCode)) {
        echo "verification Code not Found";
    }else {
        $resultset =  Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `verification_code` = '" . $verificationCode . "'");
        $row = $resultset->num_rows;
        if ($row > 0) {
            $dateTime = new DateTime();
            $dateTimeZone = new DateTimeZone("Asia/colombo");
            $dateTime->setTimezone($dateTimeZone);
            $verifiedAt = $dateTime->format('Y-m-d H:i:s');

            Database::iud("UPDATE `user` SET `verified_at` = '".$verifiedAt."' WHERE `email` = '".$email."'");

            echo "Success";
        }else {
            echo "Invalid Verification Code";
        }
    }
}

?>