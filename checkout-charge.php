<?php
include("./config.php");

$token = $_POST["stripeToken"];
$contact_name = $_POST["c_name"];
$token_card_type = $_POST["stripeTokenType"];
$phone           = $_POST["phone"];
$email           = $_POST["stripeEmail"];
$address         = $_POST["address"];
$amount          = $_POST["amount"];
$desc            = $_POST["product_name"];
$pid            = $_POST["pid"];
$charge = \Stripe\Charge::create([
  "amount" => str_replace(",", "", $amount) * 100,
  "currency" => 'LKR',
  "description" => $desc,
  "source" => $token,
]);

if ($charge) {
  header("Location:success.php?pid=$pid");
}
?>
