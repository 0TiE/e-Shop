<!-- <?php
require "connection.php";
$r = Database::search("SELECT * FROM `gender`");
$n = $r->num_rows;

for ($x = 0; $x < $n; $x++) {
    $d = $r->fetch_assoc();
?>

    <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

<?php
}

?> if (t == "success") {
    fname.value = "";
    lname.value = "";
    email.value = "";
    password.value = "";
    mobile.value = "";
    document.getElementById("msg").innerHTML = "";
    changeView();



} else {
    document.getElementById("msg").innerHTML = t;


} <option value="<?php echo $cf["id"]; ?>"><?php echo $cf["name"]; ?></option>
                                    <?php
                                        $call = Database::search("SELECT * FROM `city` WHERE `name` !='" . $cf["name"] . "'");
                                        $num2 = $call->num_rows;

                                        for ($x = 1; $x <= $num2; $x++) {
                                            $row1 = $call->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>
                                        <?php
                                        }

                                        ?> -->


<!DOCTYPE html>
<html>

<head>
    <title>Cart | eShop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require "header.php"; ?>
            <div class="col-12 pt-2" style="background-color:#E3E5E4;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 border border-1 border-secondary rounded mb-3">
                <div class="row">
                    <div class="col-12">
                        <lable class="form-lable fw-bold fs-1">Basket <i class="bi bi-cart3 fs-2"></i></lable>

                    </div>
                    <div class="col-12 col-lg-6">
                        <hr class="hr-break-1" />
                    </div>
                    <!-- empty -->
                    <!-- <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-0 offset-lg-2 mb-3">
                                <input type="text" class="form-control" placeholder="Search in Basket..." />
                            </div>
                            <div class="col-12 col-lg-2 d-grid mb-3">
                                <button class="btn btn-outline-primary">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <hr class="hr-break-1" />
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 emptycart"></div>
                            <div class="col-12 text-center mb-2">
                                <label class="form-label fs-1">You have no item in your basket</label>
                            </div>
                            <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                <a href="#" class="btn btn-primary fs-3" >start Shopping</a>
                            </div>
                        </div>
                    </div> -->
                    <!-- empty -->

                    <!-- have products -->
                    <div class="col-12 col-lg-9">
                        <div class="row">

                            <div class="card mb-3 mx-0 col-12">
                                <div class="row g-0">
                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                <span class="fw-bold text-black fs-5">xxxxxxxxxxxxxxxxxxxxxxxxx</span>&nbsp;
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-4">

                                        <img src="xxxxxxxxxxxxxxxxxxx" class="img-fluid rounded-start" style="max-width: 200px;">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">

                                            <h3 class="card-title">xxxxxxxxxxxxxxxxxxx</h3>

                                            <span class="fw-bold text-black-50">Colour : xxxxxxxxxxxxxxxxxxxxxxxxx</span> &nbsp; |

                                            &nbsp; <span class="fw-bold text-black-50">Condition : xxxxxxxxxxxxxxxxxxxxxxxxx</span>
                                            <br>
                                            <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                            <span class="fw-bold text-black fs-5">Rs.xxxxxxxxxxxxxxxxxx.00</span>
                                            <br>
                                            <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                            <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="xxxxxxxxxxxxxxxxxxxxxxxxxx">
                                            <br><br>
                                            <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                            <span class="fw-bold text-black fs-5">Rs.250.00</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body d-grid">
                                            <a class="btn btn-outline-success mb-2">Buy Now</a>
                                            <a class="btn btn-outline-danger mb-2">Remove</a>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                            </div>
                                            <div class="col-6 col-md-6 text-end">
                                                <span class="fw-bold fs-5 text-black-50">Rs.xxxxxxxxxxxxxxxxxx.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- have products -->
                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <label class="form-label fs-3 fw-bold"> Summary</label>

                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-6 mb-3">
                                <span class="fs-6 fw-bold">items(2)</span>
                            </div>
                            <div class="col-6 text-end mb-3">
                                <span class="fs-6 fw-bold">Rs. 200000 .00</span>
                            </div>
                            <div class="col-6">
                                <span class="fs-6 fw-bold">Shipping</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="fs-6 fw-bold">Rs. 250 .00</span>
                            </div>
                            <div class="col-12 mt-3">
                                <hr />
                            </div>
                            <div class="col-6 mt-2">
                                <span class="fs-4 fw-bold">Total</span>
                            </div>
                            <div class="col-6 mt-2 text-end">
                                <span class="fs-4 fw-bold">Rs.200200.00</span>
                            </div>
                            <div class="col-12 mt-3 mb-3 d-grid">
                                <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>