<?php

session_start();

require "model/Connection.php";

$userId = $_SESSION["user"]["id"];

$adTitle = $_POST["ad-title"];
$adPrice = $_POST["ad-price"];
$adDescription = $_POST["ad-description"];
$adCategory = $_POST["ad-category"];

if (empty($adTitle)) {
    echo "Enter Ad Title";
} else if (empty($adPrice)) {
    echo "Enter Ad Price";
} else if (empty($adDescription)) {
    echo "Enter Ad Description";
} else if ($adCategory == 0) {
    echo "Select Ad Category";
} else if (!isset($_FILES["ad-photo1"])) {
    echo "Please add atleast one photo";
} else {

    $dateTime = new DateTime();
    $dateTimeZone = new DateTimeZone("Asia/Colombo");
    $dateTime->setTimezone($dateTimeZone);
    $postedAt = $dateTime->format("Y-m-d H:i:s");

    $uniqueId = uniqid();

    $allowedImageExtentions = array("png", "jpg", "jpeg", "svg");

    $adPhoto1 = $_FILES["ad-photo1"]["name"];
    $adPhoto1Extention = pathinfo($adPhoto1, PATHINFO_EXTENSION);

    if (in_array($adPhoto1Extention, $allowedImageExtentions)) {

        if (isset($_FILES["ad-photo2"])) {

            $adPhoto2 = $_FILES["ad-photo2"]["name"];
            $adPhoto2Extention = pathinfo($adPhoto2, PATHINFO_EXTENSION);

            if (in_array($adPhoto2Extention, $allowedImageExtentions)) {
                if (isset($_FILES["ad-photo3"])) {

                    $adPhoto3 = $_FILES["ad-photo3"]["name"];
                    $adPhoto3Extention = pathinfo($adPhoto3, PATHINFO_EXTENSION);

                    if (in_array($adPhoto3Extention, $allowedImageExtentions)) {
                        $adPhoto1Url = "assets//images//ad-photos//" . uniqid() . $adPhoto1;
                        move_uploaded_file($_FILES["ad-photo1"]["tmp_name"], $adPhoto1Url);

                        $adPhoto2Url = "assets//images//ad-photos//" . uniqid() . $adPhoto2;
                        move_uploaded_file($_FILES["ad-photo2"]["tmp_name"], $adPhoto2Url);

                        $adPhoto3Url = "assets//images//ad-photos//" . uniqid() . $adPhoto3;
                        move_uploaded_file($_FILES["ad-photo3"]["tmp_name"], $adPhoto3Url);

                        Database::iud("INSERT INTO `advertisment`(`title`, `price`, `description`, `category_id`, `user_id`, `posted_at`, `status`, `unique_id`) 
                        VALUES('" . $adTitle . "', '" . $adPrice . "', '" . $adDescription . "', '" . $adCategory . "', '" . $userId . "', '" . $postedAt . "', '1', 
                        '" . $uniqueId . "')");

                        $advertismentResultSet = Database::search("SELECT * FROM `advertisment` WHERE `unique_id` = '" . $uniqueId . "'");
                        $advertisment = $advertismentResultSet->fetch_assoc();
                        $advertismentId = $advertisment["id"];

                        Database::iud("INSERT INTO `advertisment_pic`(`url`, `advertisment_id`) VALUES('" . $adPhoto1Url . "', '" . $advertismentId . "')");
                        Database::iud("INSERT INTO `advertisment_pic`(`url`, `advertisment_id`) VALUES('" . $adPhoto2Url . "', '" . $advertismentId . "')");
                        Database::iud("INSERT INTO `advertisment_pic`(`url`, `advertisment_id`) VALUES('" . $adPhoto3Url . "', '" . $advertismentId . "')");

                        echo "Success";
                    } else {
                        echo "Invalid Image, You can only select png, jpg, jpeg or svg image";
                    }
                } else {

                    $adPhoto1Url = "assets//images//ad-photos//" . uniqid() . $adPhoto1;
                    move_uploaded_file($_FILES["ad-photo1"]["tmp_name"], $adPhoto1Url);

                    $adPhoto2Url = "assets//images//ad-photos//" . uniqid() . $adPhoto2;
                    move_uploaded_file($_FILES["ad-photo2"]["tmp_name"], $adPhoto2Url);

                    Database::iud("INSERT INTO `advertisment`(`title`, `price`, `description`, `category_id`, `user_id`, `posted_at`, `status`, `unique_id`) 
                    VALUES('" . $adTitle . "', '" . $adPrice . "', '" . $adDescription . "', '" . $adCategory . "', '" . $userId . "', '" . $postedAt . "', '1', 
                    '" . $uniqueId . "')");

                    $advertismentResultSet = Database::search("SELECT * FROM `advertisment` WHERE `unique_id` = '" . $uniqueId . "'");
                    $advertisment = $advertismentResultSet->fetch_assoc();
                    $advertismentId = $advertisment["id"];

                    Database::iud("INSERT INTO `advertisment_pic`(`url`, `advertisment_id`) VALUES('" . $adPhoto1Url . "', '" . $advertismentId . "')");
                    Database::iud("INSERT INTO `advertisment_pic`(`url`, `advertisment_id`) VALUES('" . $adPhoto2Url . "', '" . $advertismentId . "')");

                    echo "Success";
                }
            } else {
                echo "Invalid Image, You can only select png, jpg, jpeg or svg image";
            }
        } else {
            $adPhoto1Url = "assets//images//ad-photos//" . uniqid() . $adPhoto1;
            move_uploaded_file($_FILES["ad-photo1"]["tmp_name"], $adPhoto1Url);

            Database::iud("INSERT INTO `advertisment`(`title`, `price`, `description`, `category_id`, `user_id`, `posted_at`, `status`, `unique_id`) 
            VALUES('" . $adTitle . "', '" . $adPrice . "', '" . $adDescription . "', '" . $adCategory . "', '" . $userId . "', '" . $postedAt . "', '1', '" . $uniqueId . "')");

            $advertismentResultSet = Database::search("SELECT * FROM `advertisment` WHERE `unique_id` = '" . $uniqueId . "'");
            $advertisment = $advertismentResultSet->fetch_assoc();
            $advertismentId = $advertisment["id"];

            Database::iud("INSERT INTO `advertisment_pic`(`url`, `advertisment_id`) VALUES('" . $adPhoto1Url . "', '" . $advertismentId . "')");

            echo "Success";
        }
    } else {
        echo "Invalid Image, You can only select png, jpg, jpeg or svg image";
    }
}
