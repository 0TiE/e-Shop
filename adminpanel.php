<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {
?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | AdminPanel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="body" style="background-color:#74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
        <div class="container-fluid">
            <div class="row" id="mainrow">
                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="align-align-items-start bg-dark col-12">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo $_SESSION["a"]["fname"] . "" . $_SESSION["a"]["lname"] ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3 " role="tablist" aria-orientation="vertical">

                                    <nav class="nav flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                                        <a class="nav-link" href="manageusers.php">Manage Users</a>
                                        <a class="nav-link" href="manageproducts.php">Manage Products</a>

                                    </nav>
                                </div>
                                <div class="col-12 mt-3">
                                    <hr class="border border-1 border-white" />
                                    <h4 class="text-white">Selling History</h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="col-12 mt-3 d-grid">
                                    <h5 class="text-white">From Date</h5>
                                    <input type="date" class="form-control" />
                                    <h5 class="text-white mt-2 fw-bold">To Date:</h5>
                                    <input type="date" class="form-control" />
                                    <a href="#" class="btn btn-primary fw-bold mt-2">View Sellings</a>
                                    <hr class="border border-1 border-white" />
                                    <hr class="border border-1 border-white" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-12 text-white fw-bold mb-3">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px; ">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily ernings </span>
                                            <br />
                                            <?php
                                            $today = date("Y-m-d");
                                            $this_month = date("m");
                                            $this_year = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $d = "0";
                                            $e = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $e = $e + $invoice_data["qty"];

                                                $f = $invoice_data["date"];
                                                $split_data = explode(" ", $f);
                                                $pdate = $split_data[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $split_result = explode("-", $pdate);
                                                $pyear = $split_result[0];
                                                $pmonth = $split_result[1];

                                                if ($pyear == $this_year) {
                                                    if ($pmonth == $this_month) {
                                                        $b = $b + $invoice_data["total"];
                                                        $d = $d + $invoice_data["qty"];
                                                    }
                                                }
                                            }



                                            ?>
                                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-light text-dark text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold ">Monthly ernings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Selling</span>
                                            <br />
                                            <span class="fs-5"> <?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Selling</span>
                                            <br />
                                            <span class="fs-5"><?php echo $d; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"> <?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;

                                            ?>
                                            <span class="fs-5"><?php echo $user_num; ?> Members</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-12 col-lg-3 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>
                                <?php
                                $start_date = new DateTime("2021-06-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);

                                $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));
                                $difference = $end_date->diff($start_date);

                                ?>
                                <div class="col-12 col-lg-9 text-end mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white">
                                        <?php

                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";




                                        ?>

                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">
                                <div class="col-12 text-center"><label class="form-Label fw-bold fs-4">Mostly Sold Item </label></div>
                            </div>
                            <?php

                            $frew_rs = Database::search("SELECT `product_id`,COUNT(product_id) AS `value_occurence`
                            FROM `invoice`
                            WHERE `date` LIKE '%" . $today . "%'
                            GROUP BY `product_id`
                            ORDER BY `value_occurence` DESC
                            LIMIT 1");

                            $freq_num = $frew_rs->num_rows;
                            if ($freq_num > 0) {

                                $freq_data = $frew_rs->fetch_assoc();
                                $product_rs = Database::search("SELECT * FROM  `product` INNER JOIN `images` ON 
                                product.id=images.product_id WHERE `id`='" . $freq_data["product_id"] . "'");

                                $product_data = $product_rs->fetch_assoc();

                                $qty_rs = Database::search("SELECT SUM('qty') AS total FROM `invoice` WHERE 
                                `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%' ");
                                $qty_data = $qty_rs->fetch_assoc();
                            }
                            ?>
                            <div class="col-12">
                                <img src="<?php echo $product_data["code"] ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                <hr />
                            </div>
                            <div class="col-12 text-center">
                                <span class="fs-5 fw-bold"><?php echo $product_data["title"] ?></span>
                                <br />
                                <span class="fs-6 fw-bold"><?php echo $product_data["qty"] ?> Items</span>
                                <br />
                                <span class="fs-6 fw-bold">Rs. <?php echo $product_data["price"] ?> .00</span>
                                <br />
                            </div>
                            <div class="col-12">
                                <div class="first_place"></div>
                            </div>
                        </div>
                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">
                                <div class="col-12 text-center"><label class="form-Label fw-bold fs-4">Mostly Famouse Seller </label></div>
                            </div>
                            <?php

                            $seller_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` 
                            ON user.email=profile_img.user_email WHERE `email`='" . $product_data["user_email"] . "'");
                            $seller_data = $seller_rs->fetch_assoc();
                            ?>
                            <div class="col-12">
                                <img src="<?php echo $seller_data["code"] ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                <hr />
                            </div>
                            <div class="col-12 text-center">
                                <span class="fs-5 fw-bold"><?php echo $seller_data["fname"]." ".$seller_data["lname"] ?></span>
                                <br />
                                <span class="fs-6 fw-bold"><?php echo $seller_data["email"] ?></span>
                                <br />
                                <span class="fs-6 fw-bold"><?php echo $seller_data["mobile"] ?></span>
                                <br />
                            </div>
                            <div class="col-12">
                                <div class="first_place"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require "footer.php" ?>
        <script src="script.js"></script>
    </body>

    </html><?php

        } else {
            ?>
    <script>
        alert("Please Signin first.");
        window.location = "adminsignin.php";
    </script>
<?php

        }
?>