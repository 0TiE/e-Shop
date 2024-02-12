<?php
require "connection.php";
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;


if (isset($_POST["e"])) {
    $email = $_POST["e"];

    if (empty($email)) {
        echo "Please enter your Email Address;";
    } else {
        $adminrs = Database::search("SELECT * FROM `admin` where `email`='" . $email . "'");
        $an = $adminrs->num_rows;

        if ($an == 1) {
            $code = uniqid();
            Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ravidunalawaththa@gmail.com';
            $mail->Password = 'tjfgqvjzbklurert';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('ravidunalawaththa@gmail.com', 'eShop');
            $mail->addReplyTo('ravidunalawaththa@gmail.com', 'eShop');
            $mail->addAddress('ravidunalawaththa@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'Admin  Verification code';
            $bodyContent = '<h1 style="color:green;"> Your verification Code is :' . $code . '<h1/>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'verification code sending failed';
            } else {
                echo 'Success';
            }
        } else {

            echo "You are not a valid user.";
        }
    }
}
// vqatfnyqbtlexnxw