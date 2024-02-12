<?php

session_start();
require "connection.php";

$senders_email  = $_SESSION["a"]["email"];
$recivers_email = $_POST["email"];

$message_rs = Database::search("SELECT * FROM `message` WHERE `from`='" . $senders_email . "' 
OR `to`='" . $senders_email . "'");

$message_num = $message_rs->num_rows;

for ($x = 0; $x < $message_num; $x++) {

    $message_data = $message_rs->fetch_assoc();

    if ($message_data["from"] == $senders_email & $message_data["to"] == $recivers_email) {

?>

        <!-- receved -->
        
      <div class="col-12 mt-2">
            <div class="col-12">
                <div class="row">
                    <div class=" offset-4 col-8 rounded bg-primary">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-white fs-4"><?php echo $message_data["content"]; ?></span>
                            </div>
                            <div class="col-12  text-end pb-2">
                                <span class="text-white fs-6"><?php echo $message_data["date_time"]; ?></span>
                                <span class="text-white fs-6 invisible" id="rmail"><?php echo $message_data["from"]; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- receved -->

    <?php

    } else if ($message_data["from"] == $recivers_email & $message_data["to"] == $senders_email) {

    ?>

        <!-- sent -->
        <div class="col-12 mt-2">
            <div class="col-12">
                <div class="row">
                    <div class="col-8 rounded bg-success">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-white fs-4"><?php echo $message_data["content"]; ?></span>
                            </div>
                            <div class="col-12  text-end pb-2">
                                <span class="text-white fs-6"><?php echo $message_data["date_time"]; ?></span>
                                <span class="text-white fs-6 invisible" id="rmail"><?php echo $message_data["from"]; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- sent -->

<?php

    }

    if ($message_data["status"] == 0) {

        Database::iud("UPDATE `message` SET `status`='1' WHERE `from`='" . $senders_email . "' 
        AND `to`='" . $recivers_email . "'");
    }
}



?>