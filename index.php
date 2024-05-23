<?php

session_start();

require "model/Connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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

            <main>

                <div class="col-12">
                    <div class="row justify-content-center ">
                        <div class="col-12 col-md-10 col-lg-8">
                            <div class="row my-5 g-3">
                                <div class="col-12">
                                    <span class="fw-bold">Browse Category</span>
                                </div>

                                <div class="col-12">
                                    <div class="row g-2">
                                        <?php

                                        $categoryResultSet = Database::search("SELECT * FROM `category`");
                                        $categoryRow = $categoryResultSet->num_rows;
                                        for ($i = 0; $i < $categoryRow; $i++) {
                                            $category = $categoryResultSet->fetch_assoc();
                                            $categoryId = $category["id"];
                                            $advertismentResultSet = Database::search("SELECT * FROM `advertisment` INNER JOIN `category` 
                                            ON `advertisment`.`category_id` = `category`.`id` WHERE `advertisment`.`category_id` = '" . $categoryId . "'");
                                            $adsRow = $advertismentResultSet->num_rows;
                                        ?>
                                            <div class="col-6 col-md-4 col-lg-3">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <img src="<?php echo $category["category_url"]; ?>" width="40rem" />
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <a class="link-dark text-decoration-none" href="adsByCategory.php?id=<?php echo $categoryId; ?>"><?php echo $category["name"]; ?></a>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <small>(<?php echo $adsRow ?> ads)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bolder" id="staticBackdropLabel">Log In</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="login-email" class="form-label fw-bold">Email</label>
                                    <input id="login-email" type="email" class="form-control" placeholder="example@gmail.com">
                                </div>
                                <div class="col-12">
                                    <label for="login-password" class="form-lable fw-bold">Password</label>
                                    <input id="login-password" type="password" class="form-control" placeholder="*************">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-12 d-grid">
                                <button type="button" class="btn btn-primary" onclick="logIn();">Log In</button>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="button" class="btn btn-success" onclick="showSignUpModal();">Creat New
                                    Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="signup-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bolder" id="staticBackdropLabel">Sign Up</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="signup-name" class="form-label fw-bold">Name</label>
                                    <input id="signup-name" type="email" class="form-control" placeholder="It's me">
                                </div>
                                <div class="col-12">
                                    <label for="signup-email" class="form-label fw-bold">Email</label>
                                    <input id="signup-email" type="email" class="form-control" placeholder="example@gmail.com">
                                </div>
                                <div class="col-12">
                                    <label for="signup-password" class="form-lable fw-bold">Password</label>
                                    <input id="signup-password" type="password" class="form-control" placeholder="*************">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-12 d-grid">
                                <button type="button" class="btn btn-primary" onclick="signUp();">Creat New
                                    Account</button>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="button" class="btn btn-success" onclick="showLogInModal2();">Already Have
                                    an Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="verification-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 fw-bolder" id="staticBackdropLabel">Email Verification</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="verification-code" class="form-label fw-bold">verification Code</label>
                                    <input id="verification-code" type="email" class="form-control" placeholder="xxxxxxxxxxxxx">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-12 d-grid">
                                <button type="button" class="btn btn-primary" onclick="verifyEmail();">Verify</button>
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