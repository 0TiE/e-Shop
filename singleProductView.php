<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];


    $productrs = Database::search("SELECT product.id,product.category,product.model_has_barnd_id,
    product.title,product.colour_id,product.price,product.qty,product.description,product.condition_id,
    product.status_id,product.user_email,product.date_time_added,product.delivery_fee_colombo,
    product.delivery_fee_other,model.name AS `mname`, brand.name AS `bname` FROM  product INNER JOIN 
    model_has_brand ON model_has_barnd_id=product.model_has_barnd_id INNER JOIN brand ON
    brand.id=model_has_brand.brand_id INNER JOIN model ON model_has_brand.model_id=model.id WHERE
    product.id='" . $pid . "';");



    $pn = $productrs->num_rows;
    $pd = $productrs->fetch_assoc();

?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eshop | Single Product View</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    </head>

    <body class="body">

        <div class="container-fluid">
            <div class="row">
                <?php
                require "header.php";
                ?>
                <hr class="hr-break-1">
                <div class="col-12 mt-0 singleproduct">
                    <div class="row">

                        <div class="bg-white" style="padding: 11px;">
                            <div class="row">

                                <div class="col-lg-2 order-lg-1 order-2">
                                    <ul>
                                        <?php
                                        $title = $pd["title"];
                                        $imagers = Database::search("SELECT * FROM images INNER JOIN product ON
                                             product.id=images.product_id WHERE product.title='" . $title . "'");

                                        $in = $imagers->num_rows;
                                        $img;
                                        if ($in == 1) {
                                            for ($x = 0; $x < $in; $x++) {
                                                $d = $imagers->fetch_assoc();
                                                if ($x == 0) {
                                                    $img = $d["code"];
                                        ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" class="mt-1 mb-1" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);" />
                                                    </li>
                                            <?php
                                                }
                                            } ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                            </li><?php

                                                } else {
                                                    ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                            </li>
                                        <?php
                                                }
                                        ?>

                                    </ul>

                                </div>
                                <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                    <div class="align-items-center border border-1 border-secondary">
                                        <div style="background-image: url('<?php echo $img; ?>'); background-repeat: no-repeat; background-size:contain; height:450px; " id="mainimg">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 order-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <nav>
                                                <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                    <li class="breadcrumb-item">
                                                        <a href="#">Home</a>
                                                    </li>
                                                    <li class="breadcrumb-item">
                                                        <a href="#" class="text-text-decoration-none text-black-50 fw-bold">Single Product View</a>
                                                    </li>
                                                </ol>
                                            </nav>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-lable fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-1">
                                                <span class="badge">

                                                    <i class="fa fa-star mt-1  text-warning fs-6"></i>
                                                    <i class="fa fa-star mt-1  text-warning fs-6"></i>
                                                    <i class="fa fa-star mt-1  text-warning fs-6"></i>
                                                    <i class="fa fa-star mt-1  text-warning fs-6"></i>
                                                    <i class="fa fa-star-half mt-1  text-warning fs-6"></i> &nbsp;&nbsp;&nbsp;

                                                    <label class="text-dark fs-6">4.5 Stars</label>
                                                    <label class="text-dark fs-6">35 | 35 Ratings & Reviews </label>
                                                </span>
                                            </div>
                                            <div class="col-12 d-inline-block">
                                                <label class="fw-bold fs-4 mt-1" id="unitPrice">Rs. <?php echo $pd["price"]; ?>. 00</label>&nbsp;&nbsp;&nbsp;
                                                <label class="fw-bold fs-6 mt-1 text-danger"><del>Rs. <?php $p = $pd["price"];
                                                                                                        $n = ($pd["price"] / 100) * 5;
                                                                                                        $newval = $p + $n;
                                                                                                        echo $newval;  ?>. 00</del></label>
                                            </div>
                                            <hr class="hr-break-1">
                                            <div class="col-12">
                                                <label class="text-primary fs-6 fw-bold">Warrenty : 06 mounths warrenty</label><br />
                                                <label class="text-primary fs-6 fw-bold"><b>Return Policy :</b> 01 mounth Return Policy</label><br />
                                                <label class="text-primary fs-6 fw-bold"><b class="text-success">in Stock :</b> <?php echo $pd["qty"]; ?> Items left</label><br />
                                            </div>
                                            <hr class="hr-break-1">
                                            <div class="col-12">
                                                <?php

                                                $users = Database::search("SELECT * FROM user WHERE `email`='" . $pd["user_email"] . "'");
                                                $userd = $users->fetch_assoc();

                                                ?>
                                                <label class="text-dark fs-3 fw-bold mb-3"> Seller's Details</label><br />
                                                <label class="text-success fs-6 fw-bold "> Seller's Name: <?php echo $userd["fname"] . "" . $userd["lname"]; ?></label><br />
                                                <label class="text-success fs-6 fw-bold "> Seller's Email: <?php echo $userd["email"]; ?></label><br />
                                                <label class="text-success fs-6 fw-bold "> Seller's Mobile: <?php echo $userd["mobile"]; ?></label><br />


                                            </div>
                                            <hr class="hr-break-1">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-lg-8 rounded border border-1 border-primary mt-1 t-2">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 col-lg-1">
                                                                <img src="resources/pricetag.png" height="70%">
                                                            </div>
                                                            <div class="col-md-9 col-sm-9 mt-1 pe-1 col-lg-11 ">
                                                                <label class="mt-2"> Stand a chance to get instant 5% discount by using VISA.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr class="hr-break-1">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6" style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                        <div class="col-12">
                                                            <span>Qty :</span>
                                                            <input id="qtyinput" type="text" class="border-0 fs-6 fw-bold text-start " pattern="[0-9]" value="1" onkeyup='check_val(<?php echo $pd["qty"]; ?>);' />
                                                            <div class="position-absolute qty_buttons">
                                                                <div class="d-flex flex-colum align-items-center border border-1 border-secondary qty_inc">
                                                                    <i class="fas fa-chevron-up" onclick='qty_inc(<?php echo $pd["qty"]; ?>);'></i>
                                                                </div>
                                                                <div class="d-flex flex-colum align-items-center border border-1 border-secondary qty_dec">
                                                                    <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="row">

                                                            <div class="col-4 col-lg-5 d-grid">
                                                                <button class="btn btn-primary">ADD To Cart</button>
                                                            </div>
                                                            <div class="col-4 col-lg-5 d-grid">
                                                                <button class="btn btn-success" onclick="checkOut('<?php echo $pid; ?>');">By Now</button>
                                                            </div>
                                                            <div class="col-4 col-lg-2 d-grid">
                                                                <button class="btn btn-light"><i class="fas fa-heart fs-4 mt-1"></i></button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Related items</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 bg-white">
                        <div class="col-mb-12">
                            <div class="row p-2" style="text-align:justify;">
                                <?php
                                $prod = Database::search("SELECT * FROM `product` WHERE `model_has_barnd_id`='" . $pd["model_has_barnd_id"] . "' 
                               LIMIT 5");
                                //    AND `model_has_barnd_id`!='" . $pd["model_has_barnd_id"] . "'
                                $bds = $prod->num_rows;
                                for ($y = 0; $y < $bds; $y++) {
                                    $pdf = $prod->fetch_assoc();
                                ?>
                                    <div class="card me-1" style="width: 18rem;">
                                        <?php

                                        $pimgrs = Database::search("SELECT * FROM images WHERE `product_id`='" . $pdf["id"] . "'");
                                        $pimgf = $pimgrs->fetch_assoc();

                                        ?>
                                        <img src="<?php echo $pimgf["code"]; ?>" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $pdf["title"]; ?></h5>
                                            <p class="card-text"><?php echo $pdf["price"]; ?></p>
                                            <a href="#" class="btn btn-primary fsm2">Add cart</a>
                                            <a href="#" class="btn btn-primary fsm2" >Buy Now</a>
                                            <a href="#" class="mt-2 fs-6"><i class="fas fa-heart mt-1 fs-4 text-black-50"></i></a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-6 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Send Feedback</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 ">
                        <div class="row">

                            <div class="col-12  col-lg-6 bg-white border border-1 border-secondary">
                                <div class="row">

                                    <div class="col-2">
                                        <label class="form-lable fw-bold"> Brand</label>
                                    </div>
                                    <div class="col-10">
                                        <label class="form-lable"><?php echo $pd["bname"]; ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-lable fw-bold"> Model</label>
                                    </div>
                                    <div class="col-10">
                                        <label class="form-lable"><?php echo $pd["mname"]; ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-lable fw-bold"> Discription</label>
                                    </div>
                                    <div class="col-10">
                                        <textarea class="form-lable" cols="50" rows="10" disabled><?php echo $pd["description"]; ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12  col-lg-6 bg-white border border-1 border-secondary">

                                <div class="row">
                                    <div class="col-12 mt-5">

                                        <div class="row">
                                            <div class="col-12 col-lg-3 fw-bold ">
                                                <label>Feedback Type</label>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="r1" checked>
                                                    <label class="form-check-label text-success fw-bold" for="r1">
                                                        Psitive
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="r2">
                                                    <label class="form-check-label text-warning fw-bold" for="r2">
                                                        Neutral
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="r3">
                                                    <label class="form-check-label text-danger fw-bold" for="r3">
                                                        Negative
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fw-bold">Customer's Email</label>
                                            </div>
                                            <div class="col-6">
                                                <input id="e" type="email" class="form-control" value="<?php echo $_SESSION["u"]["email"] ?>" placeholder="ex:- john@gmail.com" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fw-bold">Cuctermer's Feedback</label>
                                            </div>
                                            <div class="col-8">
                                                <textarea cols="30" rows="8" class="form-control" id="f"> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" offset-lg-3 col-12 col-lg-8 d-grid mt-2 mb-3">
                                        <button class="btn btn-outline-primary" onclick="saveFeed(<?php echo $pid ?>);">Send Feedback</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <hr class="border-secondary" />
                    </div>
                    <div class="col-12 ">
                        <div class="row g-2">
                            <?php
                            $feedback_rs = Database::search("SELECT * FROM  `feedback` WHERE `product_id`='" . $pid . "'");

                            $feedback_num = $feedback_rs->num_rows;
                            for ($x = 0; $x < $feedback_num; $x++) {
                                $feedback_data = $feedback_rs->fetch_assoc();
                            ?>
                                <div class="col-12 col-lg-3 bg-white  border border-1 border-warning rounded">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <?php

                                            $user_rs = Database::search("SELECT * FROM `user`  WHERE `email`='" . $feedback_data["user_email"] . "'");

                                            $user_data = $user_rs->fetch_assoc();

                                            ?>
                                            <sapan class="fs-5 text-center fs-4 fw-bold text-primary"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?> </sapan>
                                            <br />
                                            <span class="fs-6 fw-bold text-secondary"><?php echo $feedback_data["user_email"] ?></span>
                                        </div>
                                        <div class=" mt-2 offset-1 col-10 text-center border border-warning rounded  overflow-auto" style="height: 100px;">
                                            <p class="fs-6 text-black-50"><?php echo $feedback_data["feed"] ?></p>
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <span class="fs-6 text-black-50"><?php echo $feedback_data["date"] ?></span>
                                        </div>
                                        <div class="col-12 mt-1 mb-3 ">
                                            <div class="row">

                                                <?php
                                                if ($feedback_data["type"] == 1) {
                                                ?>
                                                    <div class="offset-1 col-10 bg-success text-center">
                                                        <span class="fs-5 fw-bold text-white">Positive Feedback</span>
                                                    </div>
                                                <?php
                                                } else if ($feedback_data["type"] == 2) {
                                                ?>
                                                    <div class="offset-1 col-10 bg-warning text-center">
                                                        <span class="fs-5 fw-bold text-white">Neutral Feedback</span>
                                                    </div>
                                                <?php
                                                } else if ($feedback_data["type"] == 3) {
                                                ?>
                                                    <div class="offset-1 col-10 bg-danger text-center">
                                                        <span class="fs-5 fw-bold text-white">Negative Feedback</span>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
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
        </div>




        <?php
        require "footer.php";
        ?>




        <script src="script.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>

    </html> <?php
        } else {
            echo "Sorry for the inconvenient.";
        }


            ?>