<?php

session_start();

require "../model/Connection.php";

if (isset($_SESSION["admin"])) {
?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Log In</title>

        <link rel="stylesheet" href="../assets/css/bootstrap.css" />
        <link rel="stylesheet" href="../assets/css/header.css" />
        <link rel="stylesheet" href="../assets/css/style.css" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <header class="header bg-primary">
                    <nav>
                        <div class="logo">
                            <a href="index.php">Final Project</a>
                        </div>
                        <input type="checkbox" id="menu-toggle">
                        <label for="menu-toggle" class="menu-icon">&#9776;</label>
                        <ul class="menu">
                            <li><a href="manageAds.php">Manage Ads</a></li>
                            <li><a href="manageUsers.php">Manage Users</a></li>
                            <li><a href="manageCategory.php">Manage Categories</a></li>
                            <li><a href="#">Sign Out</a></li>
                        </ul>
                    </nav>
                </header>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12">
                            <div class="row justify-content-center mt-3">
                                <div class="col-10 col-md-3 m-2">
                                    <div class="row py-5 bg-light border border-primary rounded rounded-3 text-center">
                                        <div class="col-12">
                                            <span class="fs-5">Total Users</span>
                                        </div>
                                        <div class="col-12">
                                            <?php
                                            $userResultSet = Database::search("Select * from `user`");
                                            ?>
                                            <span class="fs-4 fw-bold"><?php echo $userResultSet->num_rows; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-10 col-md-3 m-2">
                                    <div class="row py-5 bg-light border border-primary rounded rounded-3 text-center">
                                        <div class="col-12">
                                            <span class="fs-5">Total Ads</span>
                                        </div>
                                        <div class="col-12">
                                            <?php
                                            $advertismentResultSet = Database::search("Select * from `advertisment`");
                                            ?>
                                            <span class="fs-4 fw-bold"><?php echo $advertismentResultSet->num_rows; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-10 col-md-3 m-2">
                                    <div class="row py-5 bg-light border border-primary rounded rounded-3 text-center">
                                        <div class="col-12">
                                            <span class="fs-5">Total Categories</span>
                                        </div>
                                        <div class="col-12">
                                            <?php
                                            $categoryResultSet = Database::search("Select * from `category`");
                                            ?>
                                            <span class="fs-4 fw-bold"><?php echo $categoryResultSet->num_rows; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>