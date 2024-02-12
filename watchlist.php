<?php

require "connection.php";



?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Watchlist | eShop</title>
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body class="body">
    <?php require "header.php";
    if (isset($_SESSION["u"])) {

        $mail = $_SESSION["u"]["email"]; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-secondary rounded mb-3 mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label fs-1 fw-bold">Watchlist <i class="bi bi-heart fs-2"></i></label>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <hr class="hr-break-1" />
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in watchlist......">
                                        </div>
                                        <div class="col-12 col-lg-2 d-grid mb-3">
                                            <button class="btn btn-outline-primary">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <hr class="hr-break-1" />
                                </div>
                                <div class="col-11 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-primary">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                                        <a class="nav-link" href="#">My watchlist</a>
                                        <a class="nav-link" href="#">My cart</a>
                                        <a class="nav-link disabled">Recently View</a>
                                    </nav>
                                </div>
                                <?php




                                $products = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $mail . "'");
                                $productCount = $products->num_rows;

                                if ($productCount == 0) {
                                ?>
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 epmtyview"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-lable1 fs-1 fw-bolder mb-3">You have no items in your watchlist</label>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- no item -->
                                <?php

                                } else {
                                ?>
                                    <!-- item -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row g-2">
                                            <?php
                                            for ($x = 0; $x < $productCount; $x++) {
                                                $product = $products->fetch_assoc();
                                                $pro_id = $product["product_id"];
                                                $prod_details = Database::search("SELECT * FROM `product` WHERE `id`='" . $pro_id . "'");
                                                $pn = $prod_details->num_rows;
                                                if ($pn = 1) {
                                                    $pf = $prod_details->fetch_assoc();
                                                    $pid = $pf["id"];

                                            ?>

                                                    <div class="card mb-3 mx-0 mx-lg-2  col-12">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <?php
                                                                $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pro_id . "'");
                                                                $in = $imagers->fetch_assoc();

                                                                ?>
                                                                <img src="<?php echo $in["code"] ?>" class="img-fluid rounded-start">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $pf["title"] ?></h5>
                                                                    <?php
                                                                    $colorrs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $pf["colour_id"] . "'");
                                                                    $clr = $colorrs->fetch_assoc();

                                                                    ?>

                                                                    <span class="fw-bold text-black-50">Colour :<?php echo $clr["name"] ?></span>&nbsp;
                                                                    <?php
                                                                    $conrs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pf["condition_id"] . "'");
                                                                    $con = $conrs->fetch_assoc();
                                                                    ?>
                                                                    <br />
                                                                    &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $con["name"] ?></span>

                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $pf["price"] ?></span>
                                                                    <br />

                                                                    <?php
                                                                    $userrs = Database::search("SELECT * FROM `user`  WHERE `email`='" . $pf["user_email"] . "'");
                                                                    $userrow = $userrs->fetch_assoc();
                                                                    ?>
                                                                    <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $userrow["fname"] ?><?php echo $userrow["lname"] ?></span>&nbsp;
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5"></span>&nbsp;


                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mt-4">
                                                                <div class="card-body d-grid">
                                                                    <a href="#" class="btn btn-outline-success mb-2">Buy now</a>
                                                                    <a href="#" class="btn btn-outline-warning mb-2">Add Cart</a>
                                                                    <a href="#" class="btn btn-outline-danger mb-2" onclick="deleteFromWatchlist(<?php echo $pf['id'] ?>);">Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>





                                            <?php


                                                }
                                            } ?>



                                        </div>
                                    </div>
                                    <!-- item -->

                                <?php
                                }

                                ?>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- no items -->
            </div>
        </div>
        </div>

        </div>

        <?php require "footer.php"; ?>

        <script src="script.js"></script>
</body>


</html>

<?php


    } else {
        echo "You have To Sign First";
    } ?>