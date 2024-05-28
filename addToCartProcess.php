<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["u"]["Email"];
        $pid = $_GET["id"];


        $product_rs = Database::search("SELECT `QTY` FROM `product_details` WHERE `Product_ID`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();
        $product_qty = $product_data["QTY"];


        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND `users_email`='" . $email . "'");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 1) {

            Database::iud("UPDATE `cart` SET `qty`=`qty`+1 WHERE `product_id`='" . $pid . "' AND `users_email`='" . $email . "'");

            echo ("Product quantity updated in the cart");

          
        } else {



            Database::iud("INSERT INTO `cart`(`qty`, `product_id`, `users_email`) VALUES ('1','" . $pid . "','" . $email . "')");
            echo ("Product added to cart");

           
        }
    }
}
