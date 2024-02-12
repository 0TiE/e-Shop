<?php

session_start();
require "connection.php";

$pid = $_POST["pid"];
$qty = $_POST["pqty"];

$umail = $_SESSION["u"]["email"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' ");
$product_data = $product_rs->fetch_assoc();

$unit_price = $product_data["price"];
$total = $unit_price * $qty;

echo $pid;


?>