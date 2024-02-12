<?Php
// echo"Hio";
session_start();
require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$color = $_POST["col"];
$qty = $_POST["qty"];
$price = $_POST["p"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["desc"];
$imagefile = $_FILES["img"];

$d = new DateTime();
$tz = new  DateTimeZone("ASIA/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;
$usermail = $_SESSION["u"]["email"];

if ($category == "0") {
    echo "Please Select a Category.";
} elseif ($brand == "0") {
    echo "Please select a brand";
} elseif ($model == "0") {
    echo "Please select a model";
} else if (empty($title)) {
    echo "Please add a title to your product.";
} elseif (strlen($title) > 100) {
    echo "Please enter a title contains 100 characters or lower.";
} elseif (empty($qty)) {
    echo "Quantity  must not be empty";
} elseif ($qty == "0" || $qty == "e" || $qty < 0) {
    echo "Please enter a valid quantity";
} elseif (empty($price)) {
    echo "Please enter a price to your product .";
} elseif (is_int($price)) {
    echo "Please enter a valid price.";
} elseif (empty($dwc)) {
    echo "plaese enter the delivery cost inside colombo";
} elseif (is_int($dwc)) {
    echo "Please enter a valid price for delivery inside colombo ";
} elseif (empty($doc)) {
    echo "plaese enter the delivery cost outside colombo";
} elseif (is_int($doc)) {
    echo "Please enter a vaild price for delivery outside colombo";
} elseif (empty($description)) {
    echo "plaese enter a description to your product";
} else {

    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE
     `brand_id`='" . $brand . "' AND `model_id`='" . $model . "'");

    if ($modelHasBrand->num_rows == 0) {
        echo "This product does not exists.";
    } else {
        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandId = $f["id"];
        Database::iud("INSERT INTO `product`
             (`category`,`model_has_barnd_id`,`colour_id`,`price`,`qty`,`description`,`title`,`condition_id`,`status_id`,`user_email`,
             `date_time_added`,`delivery_fee_colombo`,`delivery_fee_other`)VALUES('" . $category . "','" . $modelHasBrandId . "','" . $color . "','" . $price . "','" . $qty . "',
             '" . $description . "','" . $title . "','" . $condition . "','" . $status . "','" . $usermail . "','" . $date . "','" . $dwc . "','" . $doc . "')");
        $last_id = Database::$connection->insert_id;

        $allowed_image_extension = array("image/jpg", "image/jpeg", "image/png", "image/svg");

        if (isset($imagefile)) {
            $file_extension = $imagefile["type"];

            if (in_array($file_extension, $allowed_image_extension)) {
                $newimageextension;
                if ($file_extension == "image/jpg") {
                    $newimageextension = ".jpg";
                } else if ($file_extension == "image/jpeg") {
                    $newimageextension = ".jpeg";
                } else if ($file_extension == "image/png") {
                    $newimageextension = ".png";
                } else if ($file_extension == "image/svg") {
                    $newimageextension = ".svg";
                }

                $fileName = "resources//products//" . uniqid() . $newimageextension;
                move_uploaded_file($imagefile["tmp_name"], $fileName);

                Database::iud("INSERT INTO `images` (`product_id`,`code`) VALUES ('" . $last_id . "','" . $fileName . "')");
            } else {
                echo "Please select a valid image";
            }
        } else {
            echo "Please Select an Image";
        }
    }


    echo "success";
}

// echo $category;
// echo $brand;
// echo $model;
// echo $title;
// echo $condition;
// echo $color;
// echo $qty;
// echo $price;
// echo $dwc;
// echo $doc;
// echo $description;
// echo $imagefile;
