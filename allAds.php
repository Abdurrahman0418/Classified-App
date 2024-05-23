<?php

session_start();

require "model/Connection.php";

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ads</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <header class="header bg-primary">
                <nav>
                    <div class="logo">
                        <a href="index.php">final project</a>
                    </div>
                    <input type="text" id="menu-toggle">
                    <label for="menu-toggle" class="menu-icon">&#9776;</label>
                    <ul class="menu">
                        <li><a href="allAds.php">All Ads</a></li>
                        <?php
                        if (isset($_SESSION["user"])) {
                        ?>
                            <li><a href="myProfile.php">My Profile</a></li>
                            <li><a href="manageAds.php">Manage Ads</a></li>
                            <li><a onclick="signout();" href="#">Sign Out</a></li>

                        <?php
                        } else {
                        ?>
                            <li><a onclick="showLogInModal();" href="#">Log In</a></li>
                        <?php
                        }
                        ?>
                        <li><a href="postAd.php">Post Your Ads</a></li>
                    </ul>
                </nav>
            </header>

            <div class="col-12">
                <div class="row justify-content-center my-5">
                    <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                        <div class="row g-3">
                            <?php
                            $advertismentResultSet = Database::search("SELECT * FROM `advertisment` ORDER BY `posted_at` DESC");
                            $row = $advertismentResultSet->num_rows;
                            if ($row > 0) {
                                for ($i = 0; $i < $row; $i++) {
                                    $advertisment = $advertismentResultSet->fetch_assoc();

                                    $picResultSet = Database::search("SELECT * FROM `advertisment_pic` WHERE `advertisment_id`='" . $advertisment["id"] . "'");
                                    $pic = $picResultSet->fetch_assoc();

                            ?>
                                    <div class="col-12" onclick="viewSingleAd(<?php echo $advertisment['id']; ?>)">
                                        <div class="row border rounded p-3">
                                            <div class="col-4">
                                                <img src="<?php echo $pic["url"]; ?>" width="100rem">
                                            </div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="fs-5"><?php echo $advertisment["title"]; ?></span>
                                                    </div>
                                                    <div class="col-12">
                                                        <span class="fs-6"><?php echo $advertisment["price"]; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                <small class="text-secondary"><?php echo $advertisment["posted_at"]; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            <?php
                            } else {
                            ?>
                                <span>No Ads Found</span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>