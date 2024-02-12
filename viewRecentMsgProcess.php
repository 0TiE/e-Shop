<?php
// echo "Hello";
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    //echo $user_email;

    $query = "SELECT * FROM `message`";
    $allMsgrs = Database::search("$query");


    $allmsgNum = $allMsgrs->num_rows;

    for ($x = 0; $x < $allmsgNum; $x++) {
        $allMsgData = $allMsgrs->fetch_assoc();


        if ($allMsgData["to"] == $user_email) {
            echo $allMsgData["from"];
        } else {
            echo $allMsgData["to"];
        }
    }
    // echo $allmsgNum;
} else {

    echo "please Log In To  your account";
}
