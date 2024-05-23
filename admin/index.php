<?php

session_start();

if (isset($_SESSION["admin"])) {
?>
    <script>
        window.location = "dashboard.php";
    </script>
<?php
} else {
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

                <div class="col-12">
                    <div class="row justify-content-center mt-5">

                        <div class="col-12 text-center">
                            <span class="fs-1 fw-bold">Admin Log In</span>
                        </div>

                        <div class="col-11 col-sm-9 col-md-7 col-lg-5">
                            <div class="row shadow rounded p-3 g-3 mt-5">

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="example@gmail.com" />
                                </div>
                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="********************" />
                                </div>
                                <div class="col-12 d-grid">
                                    <button class="btn btn-primary" onclick="adminLogIn();">Log In</button>
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
}

?>