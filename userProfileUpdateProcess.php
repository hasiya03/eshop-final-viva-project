<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $user_email = $_SESSION["u"]["Email"];

    $name = $_POST["n"];
    $mobile = $_POST["mn"];
    $pw = $_POST["pw"];
    $email = $_POST["ea"];
    $line1 = $_POST["al1"];
    $line2 = $_POST["al2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $zp = $_POST["zp"];
   

    $user_rs = Database::search("SELECT * FROM `customer_details` WHERE `Email`='" . $user_email . "'");

    if ($user_rs->num_rows == 1) {

        Database::iud("UPDATE `customer_details` SET `Name`='" . $name . "', `Mobile_No`='" . $mobile . "' WHERE `Email`='" . $user_email . "'");

        $address_rs = Database::search("SELECT * FROM `customer_address` WHERE `Customer_details_Email`='" . $user_email . "'");

        $address_num = $address_rs->num_rows;

        if ($address_num == 1) {

            Database::iud("UPDATE `customer_address` SET `First_Line`='" . $line1 . "', `Second_Line`='" . $line2 . "',`ZIP_code`='" . $zp . "',`City_City_Id`='" . $city . "' WHERE `Customer_details_Email`='" . $user_email . "'");

        } else {

            Database::iud("INSERT INTO `customer_address`(`First_Line`,`Second_Line`,`ZIP_code`,`City_City_Id`,`Customer_details_Email`) 
                        VALUES ('" . $line1 . "','" . $line2 . "','" . $zp . "','" . $city . "','" . $user_email . "')");

        }
        if(sizeof($_FILES)==1){

        $image = $_FILES["img"];
        $image_extension = $image["type"];

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        if(in_array($image_extension , $allowed_image_extentions)){
            $new_img_extension;

            if ($image_extension == "image/jpg") {
                $new_img_extension = ".jpg";
            } else if ($image_extension == "image/jpeg") {
                $new_img_extension = ".jpeg";
            } else if ($image_extension== "image/png") {
                $new_img_extension = ".png";
            } else if ($image_extension == "image/svg+xml") {
                $new_img_extension = ".svg";
            }


            $file_name = "pics//profile_pics//" . $name . "_" .  uniqid() .$new_img_extension;
            move_uploaded_file($image["tmp_name"], $file_name);

            $image_rs = Database::search("SELECT * FROM `profile_pics` WHERE `Customer_details_Email` = '" . $user_email . "'");

           
           
            if($image_rs->num_rows== 1){

                Database::iud("UPDATE `profile_pics` SET `Image_path`='" . $file_name . "' WHERE `Customer_details_Email` = '" . $user_email . "'");
                echo("updated");

            }else {

                Database::iud("INSERT INTO `profile_pics`(`Image_path`,`Customer_details_Email`) VALUES ('" . $file_name . "','" . $user_email . "')");
                echo("saved");
            
            }
            
        }

        }else if(sizeof($_FILES)==0){
            echo("you have not selected any image.");

        }else{
            echo("you can only select one image.");

        }



    } else {

        echo("Invalid User.");
    }
}