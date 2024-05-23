<?php

session_start();

if (isset($_SESSION["user"])) {
?>
    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Profile</title>

        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="assets/css/style.css">
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
                            <div class="row shadow g-3 p-3 rounded">


                                <?php
                                if ($_SESSION["user"]["profile_url"] == "") {
                                ?>
                                    <div class="col-12 text-center">
                                        <img src="assets/images/default-profile.svg" height="150ccm" width="150cm" id="show-profile-pic">
                                    </div>

                                    <div class="col-12 text-center">
                                        <label for="profile-pic" class="btn btn-outline-success" onclick="selectImage();">Select
                                            Image</label>
                                        <input id="profile-pic" type="file" accept="image/" class="d-none">
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <img src="<?php echo $_SESSION["user"]["profile_url"]; ?>" height="150ccm" width="150cm" id="show-profile-pic">
                                    </div>

                                    <div class="col-12 text-center">
                                        <label for="profile-pic" class="btn btn-outline-success" onclick="selectImage();">Change
                                            Image</label>
                                        <input id="profile-pic" type="file" class="d-none">
                                    </div>
                                <?php
                                }

                                ?>



                                <div class="col-12">
                                    <label for="profile-name" class="form-lable">Name</label>
                                    <input type="text" class="form-control" id="profile-name" placeholder="Eg: Abdurrahman" value="<?php echo $_SESSION["user"]["name"]; ?>">
                                </div>

                                <div class="col-12">
                                    <label for="profile-email" class="form-lable">Email</label>
                                    <input type="email" class="form-control" id="profile-email" placeholder="example@gmail.com" value="<?php echo $_SESSION["user"]["email"]; ?>" disabled>
                                </div>

                                <div class="col-12">
                                    <label for="profile-current-password" class="form-lable">Current Password</label>
                                    <input type="password" class="form-control" id="profile-current-password" placeholder="**************">
                                </div>

                                <div class="col-12">
                                    <label for="profile-new-password" class="form-lable">New Password</label>
                                    <input type="password" class="form-control" id="profile-new-password" placeholder="**************">
                                </div>

                                <div class="col-12 d-grid">
                                    <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <script src="assets/js/main.js"></script>
        <script src="assets/js/header.js"></script>
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