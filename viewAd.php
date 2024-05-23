<?php

session_start();

require "model/Connection.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $adsResultSet = Database::search("SELECT * FROM `advertisment` 
        INNER JOIN `category` ON `advertisment`.`category_id` = `category`.`id` 
        WHERE `advertisment`.`id` =  '" . $id . "'");
        $adsRow = $adsResultSet->num_rows;
        if ($adsRow > 0) {
            $ad = $adsResultSet->fetch_assoc();
?>
            <!DOCTYPE html>

            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <title><?php echo $ad["title"]; ?></title>

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

                                <div class="col-11 col-sm-9 col-md-7 col-lg-5">
                                    <div class="row shadow rounded p-3 g-3">

                                        <!-- <div class="col-12 text-center">
                                <span class="fs-3 fw-bold">Add Advertisment</span>
                            </div> -->

                                        <div class="col-12">
                                            <label for="ad-title" class="form-label">Title</label>
                                            <input type="text" id="ad-title" class="form-control" value="<?php echo $ad["title"]; ?>" disabled>
                                        </div>

                                        <div class="col-12">
                                            <label for="ad-price" class="form-label">Price</label>
                                            <input type="number" id="ad-price" class="form-control" value="<?php echo $ad["price"]; ?>" disabled>
                                        </div>

                                        <div class="col-12">
                                            <label for="ad-description" class="form-label">Description</label>
                                            <textarea id="ad-description" rows="5" class="form-control" disabled><?php echo $ad["description"]; ?></textarea>
                                        </div>

                                        <div class="col-12">
                                            <label for="ad-category" class="form-label">Category</label>
                                            <input type="text" id="ad-category" class="form-control" value="<?php echo $ad["name"]; ?>" disabled>
                                        </div>

                                        <?php
                                        $userResultSet = Database::search("SELECT * FROM `user` WHERE `id` = '" . $ad["user_id"] . "'");
                                        $user = $userResultSet->fetch_assoc();
                                        ?>

                                        <div class="col-12">
                                            <label for="ad-posetd-at" class="form-label">Posted At</label>
                                            <input type="text" id="ad-posetd-at" class="form-control" value="<?php echo $ad["posted_at"]; ?>" disabled>
                                        </div>

                                        <div class="col-12">
                                            <div class="row p-2">

                                                <?php

                                                $adsPicResultSet = Database::search("SELECT * FROM `advertisment_pic`  
                                                INNER JOIN `advertisment` ON `advertisment`.`id` = `advertisment_pic`.`advertisment_id`
                                                WHERE `advertisment`.`id` =  '" . $id . "'");

                                                $picsRow = $adsPicResultSet->num_rows;

                                                for ($i = 0; $i < $picsRow; $i++) {
                                                    $adsPic = $adsPicResultSet->fetch_assoc();
                                                ?>
                                                    <div class="col-4">
                                                        <div class="row border p-1 rounded">
                                                            <div class="col-12">
                                                                <img src="<?php echo $adsPic["url"]; ?>" width="100%" height="100%" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }

                                                ?>

                                            </div>
                                        </div>


                                        <div class="col-12 d-grid">
                                            <?php
                                            if ($ad["status"] == 1) {
                                            ?>
                                                <button class="btn btn-warning text-white" onclick="changeAdStatus(<?php echo $id; ?>)">Deactive</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-success" onclick="changeAdStatus(<?php echo $id; ?>)">Active</button>
                                            <?php
                                            }
                                            ?>
                                        </div>

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

        <?php
        } else {
        ?>
            <script>
                window.location = 'manageAds.php';
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            window.location = 'manageAds.php';
        </script>
    <?php
    }
} else {
    ?>
    <script>
        window.location = 'index.php';
    </script>
<?php
}
?>