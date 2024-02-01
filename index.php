<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/login.css">
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
                        <li><a href="#">All Ads</a></li>
                        <li><a onclick="showLogInModal();">Log In</a></li>
                        <li><a href="#">Post Your Ads</a></li>
                    </ul>
                </nav>
            </header>

            <div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <input id="login-email" type="email" class="form-control"
                                        placeholder="example@gmail.com">
                                </div>
                                <div class="col-12">
                                    <label for="login-password" class="form-lable fw-bold">Password</label>
                                    <input id="login-password" type="password" class="form-control"
                                        placeholder="*************">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-12 d-grid">
                            <button type="button" class="btn btn-primary" onclick="logIn();">Log In</button>
                            </div>
                            <div class="col-12 d-grid">
                            <button type="button" class="btn btn-success" onclick="showSignUpModal();">Creat New Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="signup-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-primary" onclick="signUp();">Creat New Account</button>
                            </div>
                            <div class="col-12 d-grid">
                            <button type="button" class="btn btn-success" onclick="showLogInModal2();">Already Have an Account</button>
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