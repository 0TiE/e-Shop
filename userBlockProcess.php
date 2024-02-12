<?php
require "connection.php";

if (isset($_GET["id"])) {
    $user_email = $_GET["id"];
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $user_email . "'");
    $user_num = $user_rs->num_rows;
    if ($user_num == 1) {
        $user_data = $user_rs->fetch_assoc();
        $user_status = $user_data["status_id"];
        if ($user_status == "1") {
            Database::iud("UPDATE `user` SET `status_id`='2' WHERE `email`='" . $user_email . "'");
           echo "Success 1";
        } elseif ($user_status == "2") {
            Database::iud("UPDATE `user` SET `status_id`='1' WHERE `email`='" . $user_email . "'");
           echo "Success 2";
        }
    }
}
