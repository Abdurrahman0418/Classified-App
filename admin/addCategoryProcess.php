<?php

require "../model/Connection.php";

$categoryName = $_POST["category-name"];

if (empty($categoryName)) {
    echo "Enter Category Name";
} else if (!isset($_FILES["category-image"])) {
    echo "Select Category Image";
} else {

    $categoryResultSet = Database::search("SELECT * FROM `category` WHERE `name` = '" . $categoryName . "'");
    $rows = $categoryResultSet->num_rows;

    if ($rows > 0) {
        echo "This Category Name already exists";
    } else {
        $allowedImageExtentions = array("png", "jpg", "jpeg", "svg");

        $categoryImage = $_FILES["category-image"]["name"];
        $imageExtention = pathinfo($categoryImage, PATHINFO_EXTENSION);

        if (in_array($imageExtention, $allowedImageExtentions)) {

            $uniqueId = uniqid();

            $categoryImageUrl = "..//assets//images//category-icons//" . $uniqueId . $categoryImage;
            $categoryImageDBUrl = "assets//images//category-icons//" . $uniqueId . $categoryImage;
            move_uploaded_file($_FILES["category-image"]["tmp_name"], $categoryImageUrl);

            Database::iud("INSERT INTO `category`(`name`,`category_url`) VALUES('" . $categoryName . "','" . $categoryImageDBUrl . "')");

            echo "Success";
        } else {
            echo "Invalid Image, You can only select png, jpg, jpeg or svg image";
        }
    }
}
