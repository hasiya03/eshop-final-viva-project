<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT* FROM `customer_details` WHERE `Email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = uniqid(); //verification code

        Database::iud("UPDATE `customer_details` SET `Verification_code`='" . $code . "' WHERE `Email`='" . $email . "'");

        $mail = new PHPMailer; 
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hasindu.balasooriya@gmail.com';
        $mail->Password = 'ofqwswgcikprmmxd';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('hasindu.balasooriya@gmail.com', 'Reset Password');
        $mail->addReplyTo('hasindu.balasooriya@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'New Tech Password Verification code';
        $bodyContent = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; color: aliceblue; background-color: rgb(18, 18, 18);">
            <h2 style=" text-align: center;">Password Reset Request</h2>
            <p style="font-size: 16px;">Hello,</p>
            <p style="font-size: 16px;">We received a request to reset your password for your New Tech account. Please use the verification code below to proceed with resetting your password.</p>
            <div style="text-align: center; margin: 20px 0;">
                <span style="display: inline-block;  background-color: aliceblue; color: black; padding: 10px 20px; font-size: 20px; border-radius: 4rem;">' . $code . '</span>
            </div>
            <p style="font-size: 16px; color: aliceblue;">If you did not request a password reset, please ignore this email. This verification code will expire in 30 minutes.</p>
            <p style="font-size: 16px;">Thank you,<br>New Tech Customer Support</p>
            <hr>
            <p style="font-size: 12px; color: aliceblue; text-align: center;">If you have any questions, feel free to contact our support team at <a href="mailto:support@newtech.com" style="color: #007bff;">support@newtech.com</a>.</p>
        </div>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification Code Sending Failed.");
        } else {
            echo ("successfully sent verification code");
        }
    } else {
        echo ("verification code Invalid Email Address.");
    }
} else {
    echo ("Please enter your Email Address First.");
}
