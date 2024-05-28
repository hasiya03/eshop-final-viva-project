<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT* FROM `customer_details` WHERE `Email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();//verification code

        Database::iud("UPDATE `customer_details` SET `Verification_code`='".$code."' WHERE `Email`='".$email."'");

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
            $bodyContent = '<h1 style="color:Red;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo ("Verification Code Sending Failed.");
            }else{
                echo ("successfully sent verification code");
            }

    }else{
        echo ("verification code Invalid Email Address.");
    }

}else{
    echo ("Please enter your Email Address First.");
}

?>

