<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $id = $_GET["id"];
    $email = $_SESSION["u"]["email"];

    $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` ='" . $id . "'  AND `user_email`='" . $email . "'");

    if ($watchlistrs->num_rows ==1) {
        $watchresult = $watchlistrs->fetch_assoc();

        Database::iud("DELETE FROM `watchlist` WHERE  `id`= '" . $watchresult["id"] . "' ");
       
        echo "success2";
    } else {

        Database::iud("INSERT INTO `watchlist` (`product_id`,`user_email`) VALUES ('" . $id . "','" . $email . "')");
        echo "success";
    }
} else {

    echo "You have to Sign In Frist";
}
