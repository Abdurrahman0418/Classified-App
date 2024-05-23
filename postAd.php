<?php

session_start();

require "model/Connection.php";

if (isset($_SESSION["user"])) {
?>

    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Home</title>

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

                                <div class="col-12 text-center">
                                    <span class="fs-3 fw-bold">Add Advertisment</span>
                                </div>

                                <div class="col-12">
                                    <label for="ad-title" class="form-label">Title</label>
                                    <input type="text" id="ad-title" class="form-control" placeholder="Enter Ad Title">
                                </div>

                                <div class="col-12">
                                    <label for="ad-price" class="form-label">Price</label>
                                    <input type="number" id="ad-price" class="form-control" placeholder="Enter Ad Price">
                                </div>

                                <div class="col-12">
                                    <label for="ad-description" class="form-label">Description</label>
                                    <textarea id="ad-description" rows="5" class="form-control" placeholder="Enter Ad Description"></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="ad-category" class="form-label">Category</label>
                                    <select id="ad-category" class="form-select">
                                        <option value="0">Select Category</option>

                                        <?php

                                        $resultSet = Database::search("SELECT * FROM `category`");
                                        $row = $resultSet->num_rows;

                                        for ($x = 0; $x < $row; $x++) {
                                            $category = $resultSet->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="row p-2">

                                        <div class="col-4">
                                            <div class="row border p-1 rounded">
                                                <div class="col-12">
                                                    <img src="assets/images/default-ad.svg" width="100%" height="100%" id="ad-show-image1" />
                                                </div>
                                                <div class="col-12 text-center">
                                                    <label for="ad-photo1" class="btn btn-primary" onclick="selectAdPhoto1()">Select Image</label>
                                                    <input type="file" id="ad-photo1" class="form-control d-none">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row border p-1 rounded">
                                                <div class="col-12">
                                                    <img src="assets/images/default-ad.svg" width="100%" height="100%" id="ad-show-image2" />
                                                </div>
                                                <div class="col-12 text-center">
                                                    <label for="ad-photo2" class="btn btn-primary" onclick="selectAdPhoto2()">Select Image</label>
                                                    <input type="file" id="ad-photo2" class="form-control d-none">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="row border p-1 rounded">
                                                <div class="col-12">
                                                    <img src="assets/images/default-ad.svg" width="100%" height="100%" id="ad-show-image3" />
                                                </div>
                                                <div class="col-12 text-center">
                                                    <label for="ad-photo3" class="btn btn-primary" onclick="selectAdPhoto3()">Select Image</label>
                                                    <input type="file" id="ad-photo3" class="form-control d-none">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 d-grid">
                                    <button class="btn btn-primary" onclick="postAd()">Post Ad</button>
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
        window.location = "index.php";
    </script>
<?php
}
?>