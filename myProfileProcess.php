<?php

session_start();

require "model/Connection.php";

$name = $_POST["name"];
$currentPassword = $_POST["current-password"];
$newPassword = $_POST["new-password"];

$id = $_SESSION["user"]["id"];

if (empty($name)) {
    echo "Name not Found";
} else {

    $dateTime = new DateTime();
    $dateTimeZone = new DateTimeZone("Asia/colombo");
    $dateTime->setTimezone($dateTimeZone);
    $updatedAt = $dateTime->format('Y-m-d H:i:s');

    

    if (!empty($currentPassword)) {
        if (empty($newPassword)) {
            echo "New Password not found";
        } else if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s]).{8,20}$/", $newPassword)) {
            echo "Password must contains at  least one capital letter, One simple letter, One number and One symbol";
        } else {
            $userResultSet = Database::search("SELECT * FROM `user` WHERE `id` = '" . $id . "'");
            $user = $userResultSet->fetch_assoc();

            if ($user["password"] == $currentPassword) {
                if ($_SESSION["user"]["name"] != $name){
                    Database::iud("UPDATE `user` SET `name` = '" . $name . "', `password` = '" . $newPassword . "', `updated_at` = '".$updatedAt."' WHERE `id` = '" . $id . "'");
                    $_SESSION["user"]["name"] = $name;
                    $_SESSION["user"]["password"] = $newPassword;
                    echo "Success";
                }else {
                    Database::iud("UPDATE `user` SET `password` = '" . $newPassword . "', `updated_at` = '".$updatedAt."' WHERE `id` = '" . $id . "'");
                    $_SESSION["user"]["password"] = $newPassword;
                    echo "Success";
                }
                
            } else {
                echo "Wrong Current Password";
            }
        }

    }else {
        if ($_SESSION["user"]["name"] != $name){
            Database::iud("UPDATE `user` SET `name` = '" . $name . "', `updated_at` = '".$updatedAt."' WHERE `id` = '" . $id . "'");
            $_SESSION["user"]["name"] = $name;
            echo "Success";
        }else {
            echo "No Updates";
        }
        
    }
}



