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

        <title>Manage Categories</title>

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
                    <div class="row mt-5 justify-content-center">

                        <div class="col-12 text-center">
                            <span class="fs-3 fw-bold">Manage Categories</span>
                        </div>

                        <div class="col-12 col-md-10 col-lg-6">
                            <div class="row mt-3 g-3">
                                <div class="col-12 text-end">
                                    <button class="btn btn-outline-success" onclick="showAddCategoryModal()">Add New Category</button>
                                </div>
                                <div class="col-12">
                                    <table class="table table-responsive table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $categoryResultSet = Database::search("SELECT * FROM `category`");
                                            $categoryRows = $categoryResultSet->num_rows;

                                            if ($categoryRows > 0) {
                                                for ($i = 0; $i < $categoryRows; $i++) {
                                                    $category = $categoryResultSet->fetch_assoc();
                                            ?>
                                                    <tr>
                                                        <td><?php echo $category["id"]; ?></td>
                                                        <td><?php echo $category["name"]; ?></td>
                                                        <td>
                                                            <img src="../<?php echo $category["category_url"]; ?>" width="40rem" />
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="add-category-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bolder" id="staticBackdropLabel">Add New Category</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="category-name" class="form-label">Name</label>
                                        <input id="category-name" type="text" class="form-control" placeholder="Eg: Electronics">
                                    </div>
                                    <div class="col-12 text-center">
                                        <img src="../assets/images/default-ad.svg" width="40rem" id="category-show-image" />
                                    </div>
                                    <div class="col-12 d-grid">
                                        <label for="category-image" class="btn btn-primary" onclick="showCategoryImage()">Select Image</label>
                                        <input type="file" id="category-image" class="d-none">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12 d-grid">
                                    <button type="button" class="btn btn-primary" onclick="addNewCategory()">Add</button>
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