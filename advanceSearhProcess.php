<?php
require "connection.php";

$search_txt = $_POST["s"];
$category = $_POST["ca"];
$model = $_POST["m"];
$brand = $_POST["b"];
$condition = $_POST["con"];
$colour = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["sort"];
$query = "SELECT * FROM product ";

$status = 0;

if (!empty($search_txt)) {

    $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
    $status = 1;
} elseif ($category != "0" && $status == 0) {

    $query .= " WHERE `category` = '" . $category . "'";
    $status = 1;
} elseif ($category !=  "0" && $status == 1) {

    $query .= " AND  `category` = '" . $category . "'";
}

$status2 = 0;

if ($brand != "0" || $model != "0") {

    $modelHasBandId = Database::search("SELECT * FROM model_has_brand WHERE `brand_id`='" . $brand . "'
   OR `model_id`='" . $model . "'");

    $n = $modelHasBandId->num_rows;

    if ($n == "1") {
        $f = $modelHasBandId->fetch_assoc();
        $i = $f["id"];
        $status2 = 1;
    } else {
        $status2 = 0;
    }
} else {
    $status2 = 0;
}

if ($sort == 0) {

} else if ($sort == 1) {
    $query .= " ORDER BY `price` ASC ";
} else if ($sort == 2) {
    $query .= " ORDER BY `price` DESC ";
} else if ($sort == 3) {
    $query .= " ORDER BY `qty` ASC ";
} else if ($sort == 4) {
    $query .= " ORDER BY `qty` DESC ";
}

if ($status2 == 1) {

    $query .= " AND `model_has_barnd_id` = '" . $i . "'";
}
if ($condition != "0" && $status == 0) {

    $query .= " WHERE  `condition_id` = '" . $condition . "'";
    $status = 1;
} elseif ($condition != "0" && $status == 1) {

    $query .=  " AND `condition_id` = '" . $condition . "'";
}



if ($colour != "0" && $status == 0) {

    $query .= " WHERE  `colour_id` =  '" . $colour . "'";
    $status = 1;
} elseif ($condition != "0" && $status == 1) {

    $query .= " AND  `colour_id` =' " . $colour . "'";
}



if ($status == 0) {

    if (!empty($price_from) && empty($price_to)) {

        $query .= " WHERE `price` >= '" . $price_from . "'";
        $status = 1;
    } elseif (empty($price_from) && !empty($price_to)) {

        $query .= " WHERE `price`  <= '" . $price_from . "'";
        $status = 1;
    } elseif (!empty($price_from) && !empty($price_to)) {

        $query .= " WHERE  `price`  BETWEEN    '" . $price_from . "'  AND  '" . $price_to . "'";
        $status = 1;
    }
} else if ($status == 1) {
    if (!empty($price_from) && empty($price_to)) {

        $query .= " AND `price` >= '" . $price_from . "'";
        $status = 1;
    } elseif (empty($price_from) && !empty($price_to)) {

        $query .= " AND `price` <= '" . $price_from . "'";
        $status = 1;
    } elseif (!empty($price_from) && !empty($price_to)) {

        $query .= " AND  `price`  BETWEEN  '" . $price_from . "'  AND   '" . $price_to . "'";
        $status = 1;
    }
}

$query1 = $query;

// echo $query1;
?>
<div class="row">
    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">


            <?php

            if ("0" != ($_POST["page"])) {

                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }


            $products = Database::search($query1);
            $nProducts = $products->num_rows; //t0tal results
            $userProducts = $products->fetch_assoc();

            $results_per_page = 6;
            $numer_of_pages = ceil($nProducts / $results_per_page);

            $viewed_result_count = ((int) $pageno - 1) * $results_per_page;
            $query1 .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_result_count . " ";
            $selectedrs = Database::search($query1);
            $srnl = $selectedrs->num_rows;
            // echo $query;

            while ($ps = $selectedrs->fetch_assoc()) {


            ?>


                <div class="card mb-3 mt-3 col-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-4 mt-4">

                            <?php

                            $pimgrs = Database::search("SELECT * FROM images WHERE `product_id`='" . $ps["id"] . "'");
                            $presults = $pimgrs->fetch_assoc();
                            ?>
                            <img src="<?php echo $presults["code"]; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="card-title fw-bold"><?php echo $ps["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold"><?php echo $ps["price"]; ?>.00</span>
                                <br />
                                <span class="card-text text-success fw-bold fs"><?php echo $ps["qty"]; ?>Items Left</span>

                                <div class="row">
                                    <div class="col-12">

                                        <div class="row g-1">
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-success fs">Buy Now</a>
                                            </div>
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-danger fs">Add Cart</a>
                                            </div>
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-light fs"><i class="bi bi-heart-fill fs-1"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div class="offset-0 offset-lg-4 col-12 col-lg-4 mb-3">
        <div class="row">
            <div class="pagination">
                <a <?php if ($pageno <= 1) {
                        echo "#";
                    } else {
                    ?> onclick="advancedSearch('<?php echo ($pageno - 1); ?> ');" <?php
                                                                                }
                                                                                    ?>>&laquo;</a>
                <?php
                for ($page = 1; $page <= $numer_of_pages; $page++) {
                    if ($page == $pageno) {
                ?>
                        <a onclick="advancedSearch('<?php echo $page; ?> ');" class="active"><?php echo $page; ?></a>
                    <?php
                    } else {
                    ?>
                        <a onclick="advancedSearch('<?php echo $page; ?> ');"><?php echo $page; ?></a>
                <?php
                    }
                }
                ?>
                <!-- <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a> -->
                <a <?php if ($pageno >= $numer_of_pages) {
                        echo "#";
                    } else {
                    ?> onclick="advancedSearch('<?php echo ($pageno + 1); ?> ');" <?php
                                                                                }
                                                                                    ?>>&raquo;</a>
            </div>
        </div>
    </div>
</div>

<?php


?>