<?php

require "../model/Connection.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $userResultSet = Database::search("SELECT * FROM `user` WHERE `id` = '" . $id . "'");

    $row = $userResultSet->num_rows;

    if ($row > 0) {
        $user = $userResultSet->fetch_assoc();

        if ($user["status"] == 1) {
            Database::iud("UPDATE `user` SET `status` = '0' WHERE `id` = '" . $id . "'");
            echo "Success";
        } else {
            Database::iud("UPDATE `user` SET `status` = '1' WHERE `id` = '" . $id . "'");
            echo "Success";
        }
    } else {
        echo "Invalid User";
    }
} else {
    echo "Invalid Request";
}
