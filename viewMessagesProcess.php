<?php

session_start();
require "connection.php";

$recivers_email = $_SESSION["u"]["email"];
$senders_email = $_GET["email"];

$message_rs = Database::search("SELECT * FROM `message` WHERE `from`='" . $senders_email . "' 
OR `to`='" . $senders_email . "'");

$message_num = $message_rs->num_rows;

for ($x = 0; $x < $message_num; $x++) {

    $message_data = $message_rs->fetch_assoc();

    if ($message_data["from"] == $senders_email & $message_data["to"] == $recivers_email) {

?>

        <!-- reciver's message -->
        <div class="mb-3 w-50">
            <img src="resources/user_icon.svg" style="width:50px;" class="rounded-circle mb-1" />
            <div>
                <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-dark"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"]; ?></p>
                <p class="invisible" id="rmail"><?php echo $message_data["from"]; ?></p>
            </div>
        </div>
        <!-- reciver's message -->

    <?php

    } else if ($message_data["from"] == $recivers_email & $message_data["to"] == $senders_email) {

    ?>

        <!-- sender's message -->

        <div class="mb-3 w-50">
            <div>
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-white"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"]; ?></p>
            </div>
        </div>

        <!-- sender's message -->

<?php

    }

    if ($message_data["status"] == 0) {

        Database::iud("UPDATE `message` SET `status`='1' WHERE `from`='" . $senders_email . "' 
        AND `to`='" . $recivers_email . "'");
    }
}



?>