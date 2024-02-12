<?php
require "connection.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $invoice_status_rs = Database::search("SELECT `status_id` FROM `invoice` WHERE `id`='" . $id . "'");
    $invoice_status_data = $invoice_status_rs->fetch_assoc();

    $old_status = $invoice_status_data["status_id"];
    $new_status = 0;
    if ($old_status == 0) {
        Database::iud("UPDATE `invoice` SET `status_id`='1' WHERE `id`='" . $id . "'");
        $new_status = 1;
        echo $new_status;
    } elseif ($old_status == 1) {
        Database::iud("UPDATE `invoice` SET `status_id`='2' WHERE `id`='" . $id . "'");
        $new_status = 2;
        echo $new_status;
    }elseif ($old_status == 2) {
        Database::iud("UPDATE `invoice` SET `status_id`='3' WHERE `id`='" . $id . "'");
        $new_status = 3;
        echo $new_status;
    }elseif ($old_status == 3) {
        Database::iud("UPDATE `invoice` SET `status_id`='4' WHERE `id`='" . $id . "'");
        $new_status = 4;
        echo $new_status;
    }
}
