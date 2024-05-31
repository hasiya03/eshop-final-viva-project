<?php

require "connection.php";


    if (isset($_GET["email"])) {

       
        $email = $_GET["email"];



        $customer_rs = Database::search("SELECT * FROM `customer_details` WHERE `Customer_details_Email`='" . $email . "' ");
        $customer_num = $customer_rs->num_rows;

        if ($customer_num == 1) {
           
             Database::iud("DELETE FROM `customer_details` WHERE `customer_details`='" . $email . "'");
                echo ("Customer succesfully removed from the Database");
           
        } else {
            echo ("Product not found in cart");
        }
    }
