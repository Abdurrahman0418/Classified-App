<?php

session_start();

require "model/Connection.php";

$id = $_SESSION["user"]["id"];

if (isset($_FILES["image"])) {
    $allowedImageExtention = array("png", "jpg", "jpeg", "svg");

    $imageName = $_FILES["image"]["name"];

    $imageExtention = pathinfo($imageName, PATHINFO_EXTENSION);

    if (in_array($imageExtention, $allowedImageExtention)) {

        $profileUrl = "assets//images//user-profile//" . uniqid() . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $profileUrl);

        $dateTime = new DateTime();
        $dateTimeZone = new DateTimeZone("Asia/colombo");
        $dateTime->setTimezone($dateTimeZone);
        $updatedAt = $dateTime->format('Y-m-d H:i:s');

        Database::iud("UPDATE `user` SET `profile_url` = '" . $profileUrl . "', `updated_at` = '" . $updatedAt . "' WHERE `id` = '" . $id . "'");

        $_SESSION["user"]["profile_url"] = $profileUrl;

        echo "Success";

    } else {
        echo "Invalid Image, You can only select png,jpg, jpeg or svg image";
    }

} else {
    echo "File not Found";
}