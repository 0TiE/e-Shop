<?Php
require"connection.php";
$e = $_POST["email2"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if (empty($e)) {
    echo "Missing Email Address.";
} elseif (empty($np)) {
    echo "Please Enter Your new Password.";
} elseif (strlen($np) < 5 || strlen($np >= 20)) {
    echo "Password Length Should be between 5 to 20 ";
} elseif (empty($rnp)) {
    echo "Password Enter YOur Re-type password does not match";
} elseif ($np != $rnp) {
    echo "Password &Re-type password does not match";
} elseif (empty($vc)) {
    echo "Please Enter your verification code.";
} else {
    $rs = Database::search("SELECT *FROM `user`WHERE `email`='" . $e . "' AND `verification_code`='" . $vc . "'");
    if ($rs->num_rows == 1) {
        Database::iud("UPDATE `user` SET `password`='" . $np . "' WHERE `email`='" . $e . "'");
        echo "Success";
    } else {
        echo "Password reset faild";
    }
}
 