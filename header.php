<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="col-12">
        <div class="row mt-1 mb-1 ">
            <div class="col-12 col-lg-4 offset-lg-1 align-self-start">
                <span class="text-lg-start lable1"><b>Well come</b>

                    <?php

                    session_start();
                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                    ?>
                        <?php
                        echo $data["fname"];

                        ?>
                    <?php
                    } else {
                    ?>
                        <a href="index.php"> Sign In or Register</a>

                    <?php
                    }


                    ?>





                </span> |
                <span class="text-lg-start lable2">Help and contact</span> |
                <span class="text-lg-start lable2" onclick="signOut();">Sign Out</span>

            </div>
            <div class="col-12 col-lg-3 offset-lg-4 align-self-end" style="text-align: center;">
                <div class="row">
                    <div class="col-1 col-lg-3 mt-2">
                        <a class="text-decoration-none fw-bold link-dark" href="http://localhost/e-SHOP/addproduct.php">Sell</a>
                    </div>
                    <div class=" col-2 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My eshop
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="addproduct.php">My Sellings</a></li>
                            <li><a class="dropdown-item" href="myproducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="watchlist.php">Watch List</a></li>
                            <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                            <li><a class="dropdown-item" href="purchaseHistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="message.php">Messages</a></li>
                        </ul>
                    </div>
                    <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon" onclick="cart();"></div>

                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
</body>

</html>