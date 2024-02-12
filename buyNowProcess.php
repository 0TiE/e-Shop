<?php

session_start();
require "connection.php";

$pid = $_POST["pid"];
///////////
$qty = '1';

$umail = $_SESSION["u"]["email"];

$order_id = uniqid();

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' ");
$product_data = $product_rs->fetch_assoc();

$unit_price = $product_data["price"];
$total = $unit_price * $qty;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`,`status_id`)
VALUES('".$order_id."','".$pid."','".$umail."','".$date."','".$total."','".$qty."','0')");

echo $order_id;


?>