<?php

require "connection.php";


    if (isset($_GET["email"])) { 

       
        $email = $_GET["email"];



          // Delete watchlist items
  Database::iud("DELETE watchlist FROM watchlist
  JOIN product_details ON watchlist.product_id = product_details.Product_ID
  WHERE product_details.Customer_details_Email = '" . $email . "';");
  
        Database::iud("DELETE product_pics FROM product_pics
        JOIN product_details ON product_pics.Product_ID = product_details.Product_ID
        WHERE product_details.Customer_details_Email = '" . $email . "';");

// Delete cart items
Database::iud("DELETE cart FROM cart
        JOIN product_details ON cart.product_id = product_details.Product_ID
        WHERE product_details.Customer_details_Email = '" . $email . "';");
        



// Delete product details
Database::iud("DELETE FROM product_details WHERE Customer_details_Email = '" . $email . "';");

// Delete customer addresses
Database::iud("DELETE FROM customer_address WHERE Customer_details_Email = '" . $email . "';");

// Delete profile pictures
Database::iud("DELETE FROM profile_pics WHERE Customer_details_Email = '" . $email . "';");

// Delete customer details
Database::iud("DELETE FROM customer_details WHERE Email = '" . $email . "';");


echo "Customer successfully removed from the database.";
    }
