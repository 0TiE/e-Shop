<?php
require "connection.php";
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;


if (isset($_POST["n"]) && isset($_POST["e"])) {

    $new_category = $_POST["n"];
    $user_email = $_POST["e"];

    $category_rs = Database::search("SELECT * FROM `category` WHERE `name`LIKE '" . $new_category . "'");

    $category_num = $category_rs->num_rows;

    if ($category_num == 0) {

        $code = uniqid();
        Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $user_email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username =  $user_email;
        $mail->Password = 'vqatfnyqbtlexnxw';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($user_email, 'eShop');
        $mail->addReplyTo($user_email, 'eShop');
        $mail->addAddress($user_email);
        $mail->isHTML(true);
        $mail->Subject = '  Verification code';
        $bodyContent = '<h1 style="color:green;"> Your verification Code is :' . $code . '<h1/>';
        $mail->Body    = $bodyContent;


        if (!$mail->send()) {
            echo 'verification code sending failed';
        } else {
            echo 'Success';
        }
    } else {

        echo "This category exits.";
    }
}
