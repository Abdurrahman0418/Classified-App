<?php

require "../model/Connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $adResultSet = Database::search("SELECT * FROM `advertisment` WHERE `id` = '" . $id . "'");

    $row = $adResultSet->num_rows;

    if ($row > 0) {
        $ad = $adResultSet->fetch_assoc();

        if ($ad["status"] == 1) {
            Database::iud("UPDATE `advertisment` SET `status` = '0' WHERE `id` = '" . $id . "'");
            echo "Success";
        } else {
            Database::iud("UPDATE `advertisment` SET `status` = '1' WHERE `id` = '" . $id . "'");
            echo "Success";
        }
    } else {
        echo "Invalid Ad";
    }
} else {
    echo "Invalid Request";
}
