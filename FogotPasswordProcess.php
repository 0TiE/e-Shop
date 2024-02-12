<?php
require "connection.php";

require "SMTP.php";
require "Exception.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
    $email = $_GET["e"];

    if (empty($email)) {
        echo "Please enter an valid Email";
    } else {
        $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        if ($rs->num_rows == 1) {
            $code = uniqid();
            Database::iud("UPDATE `user`SET`verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ravidunalawaththa@gmail.com';
            $mail->Password = 'jvajvprcyswlcrli';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('ravidunalawaththa@gmail.com', 'eShop');
            $mail->addReplyTo('ravidunalawaththa@gmail.com', 'eShop');
            $mail->addAddress('ravidunalawaththa@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'eShop Fogot Password Verification code';
            $bodyContent = '<h1 style="color:green;"> Your verification Code is :' . $code . '<h1/>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                 echo 'Verification code sending failed';
              
            } else {
                echo 'Success';
               
            }
        } else {
            echo "Email address not fund";
        }
    }
} else {
    echo "Please enter your Email adress";
}
