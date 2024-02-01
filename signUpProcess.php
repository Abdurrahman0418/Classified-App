<?php

session_start();

require "model/Connection.php";

if (isset ($_POST["name"]) && isset ($_POST["email"]) && isset($_POST["password"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($name)) {
        echo "Name not Found";
    }else if (empty($email)) {
        echo "Email not Found";
    } else if (empty($password)) {
        echo "Password not Found";
    }else {

        $resultset =  Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."'");
        $row = $resultset->num_rows;
        if ($row > 0) {
            $user = $resultset->fetch_assoc();
            $_SESSION["user"] = $user;
            echo "success";
        }else {
            echo "Invelid Credintial";
        }
    }
}
?>