<?php
require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <title>eShop | Admins | Selling History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body class="body" style="background-color:#74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-light text-center mb-3">
                <label class="form-lalel fs-1 fw-bold text-primary">Selling History</label>
            </div>
            <div class="col-12 ">
                <div class="row">
                    <div class="col-1 bg-secondary">
                        <label class="form-lable fw-bold fs-5 text-white">Invoice ID</label>
                    </div>
                    <div class="col-3 bg-body text-end">
                        <label class="form-lable fw-bold fs-5 text-dark">Product </label>
                    </div>
                    <div class="col-3 bg-secondary text-end">
                        <label class="form-lable fw-bold fs-5 text-white">Buyer </label>
                    </div>
                    <div class="col-2  bg-body text-end">
                        <label class="form-lable fw-bold fs-5 text-dark"> Amount</label>
                    </div>
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-lable fw-bold fs-5 text-dark">Quantity </label>
                    </div>
                    <div class="col-2 bg-white"></div>
                </div>
            </div>
            <?php
            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {

                $pageno = 1;
            }
            $invoice_rs = Database::search("SELECT * FROM `invoice`");
            $invoice_num = $invoice_rs->num_rows;

            $results_per_page = 15;
            $number_of_pages = 15;
            $number_of_pages = ceil($invoice_num / $results_per_page);
            $result_count = ((int)$pageno - 1) * $results_per_page;

            $results = Database::search("SELECT `invoice`.`id`,`product`.`title`,`user`.`fname`,
            `user`.`lname`,`invoice`.`total`,`invoice`.`qty`,`invoice`.`status_id` FROM `invoice`
            INNER JOIN `user` ON 
             invoice.user_email=user.email
            INNER JOIN `product` ON 
             invoice.product_id=product.id
             LIMIT " . $results_per_page . "         
             OFFSET " . $result_count . " ");
            //$results_num=$results->num_rows;
            while ($results_data = $results->fetch_assoc()) {
            ?>
                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-1 bg-secondary">
                            <label class="form-lable fw-bold fs-5 text-white"><?php echo $results_data["id"]; ?></label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <label class="form-lable fw-bold fs-5 text-dark"><?php echo $results_data["title"]; ?></label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-lable fw-bold fs-5 text-white"><?php echo $results_data["fname"] . " " .  $results_data["lname"] ?> </label>
                        </div>
                        <div class="col-2  bg-body text-end">
                            <label class="form-lable fw-bold fs-5 text-dark">Rs. <?php echo $results_data["total"]; ?> .00</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-lable fw-bold fs-5 text-dark"><?php echo $results_data["qty"]; ?> </label>
                        </div>
                        <div class="col-2 bg-white  d-grid ">

                            <?php

                            $x = $results_data["status_id"];
                            if ($x == 0) {
                            ?><button class="btn btn-success mb-2 mt-2" onclick="changeInvoiceId(<?php echo $results_data['id'] ?>)" id="btn<?php echo $results_data['id'] ?>">Confirm Order</button>
                                <!-- packing,delivering,finish -->
                            <?php
                            } else if ($x == 1) {
                            ?><button class="btn btn-warning mb-2 mt-2" onclick="changeInvoiceId(<?php echo $results_data['id'] ?>)" id="btn<?php echo $results_data['id'] ?>">Packing</button>
                                <!-- packing,delivering,finish -->
                            <?php

                            } else if ($x == 2) {
                            ?>
                                <button class="btn btn-info mb-2 mt-2" onclick="changeInvoiceId(<?php echo $results_data['id'] ?>)" id="btn<?php echo $results_data['id'] ?>">Dispatch</button>
                                <!-- packing,delivering,finish -->
                            <?php

                            } else if ($x == 3) {

                            ?> <button class="btn btn-primary mb-2 mt-2" onclick="changeInvoiceId(<?php echo $results_data['id'] ?>)" id="btn<?php echo $results_data['id'] ?>">Shiping</button>
                                <!-- packing,delivering,finish -->
                            <?php
                            } else if ($x == 4) {
                            ?>
                                <button class="btn btn-danger mb-2 mt-2" onclick="changeInvoiceId(<?php echo $results_data['id'] ?>)" id="btn<?php echo $results_data['id'] ?>">Delivered</button>
                                <!-- packing,delivering,finish -->
                            <?php

                            } ?>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

            <div class=" offset-lg-4 col-12 col-lg-4  text-center mt-3 mb-3 d-flex justify-content-center">
                <div class="row">
                    <div class="pagination">
                        <a href="<?php if ($pageno <= 1) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno - 1);
                                    } ?>">&laquo;</a>
                        <?php
                        for ($page = 1; $page <= $number_of_pages; $page++) {
                            if ($page == $pageno) { ?>

                                <a class="active" href="<?php echo "page=" . ($page) ?>"><?php echo $page ?></a>
                            <?php
                            } else {
                            ?>
                                <a class="active" href="<?php echo "page=" . ($page) ?>"><?php echo $page ?></a>
                        <?php
                            }
                        }
                        ?>
                        <a href="<?php if ($pageno >= $number_of_pages) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno + 1);
                                    } ?>">&raquo;</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
    require "footer.php";
    ?>
    <script src="script.js"></script>
</body>

</html>