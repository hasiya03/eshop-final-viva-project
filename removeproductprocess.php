<?php

require "connection.php";


    if (isset($_GET["id"])) { 

       
        $id = $_GET["id"];
        $product_rs = Database::search("SELECT * FROM `product_details` WHERE `Product_ID`='" . $id . "'");
    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        // Delete product pics
Database::iud("DELETE FROM product_pics WHERE Product_ID = '" . $id . "';");

// Delete cart
Database::iud("DELETE FROM cart WHERE product_id = '" . $id . "';");

// Delete watchlist
Database::iud("DELETE FROM watchlist WHERE Product_id = '" . $id . "';");

// Delete product details
Database::iud("DELETE FROM product_details WHERE Product_ID = '" . $id . "';");


echo "product successfully removed from the database.";
       

        
    } else {
        echo ("Product not found ");
    }




    }



    