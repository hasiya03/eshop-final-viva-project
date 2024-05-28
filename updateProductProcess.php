<?php
session_start();
require "connection.php";

if(isset($_SESSION["p"])){
    $pid = $_SESSION["p"]["Product_ID"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $desc = $_POST["d"];
    $newp = $_POST["np"];

    Database::iud("UPDATE `product_details` SET `Name`='".$title."',`QTY`='".$qty."',
                `Shipping_colombo`='".$dwc."',`Shipping_outside_colombo`='".$doc."',
                `Product_description`='".$desc."' WHERE `Product_ID`='".$pid."'");

    $length = sizeof($_FILES);

if($length <= 3 && $length > 0){

    Database::iud("DELETE FROM `product_pics` WHERE `Product_ID`='".$pid."'");

    $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    for($x = 0;$x < $length;$x++){
        if(isset($_FILES["i".$x])){

            $img_file = $_FILES["i".$x];
            $file_extention = $img_file["type"];

            if(in_array($file_extention,$allowed_img_extentions)){

                $new_img_extention;

                if($file_extention == "image/jpg"){
                    $new_img_extention = ".jpg";
                }else if($file_extention == "image/jpeg"){
                    $new_img_extention = ".jpeg";
                }else if($file_extention == "image/png"){
                    $new_img_extention = ".png";
                }else if($file_extention == "image/svg+xml"){
                    $new_img_extention = ".svg";
                }

                $file_name = "pics//products//".$title."_".$x."_".uniqid().$new_img_extention;
                move_uploaded_file($img_file["tmp_name"],$file_name);

                Database::iud("INSERT INTO `product_pics`(`Product_Image_Path`,`Product_ID`) 
                                VALUES ('".$file_name."','".$pid."')");

                echo ("success");

            }else{
                echo ("Not an allowed image type.");
            }

        }
    }

}else{
    echo ("Invalid Image Count");
}

}
?>