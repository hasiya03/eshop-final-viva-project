<?php

session_start();
require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if(empty($email)){
    echo ("Please enter your Email Address.");
}else if(empty($password)){
    echo ("Please enter your Password.");

}else{

    $rs = Database::search("SELECT * FROM `customer_details` WHERE `Email`='".$email."' AND 
    `Password`='".$password."'");

    $n = $rs->num_rows;

    if($n == 1){

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;

        if($rememberme == "true"){
            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));
        }else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }

    }else{
        echo ("Invalid Email Address or Password");
    }

}

?>