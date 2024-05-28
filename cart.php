<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/cart.css" rel="stylesheet">
    <link href="cart.css" rel="stylesheet" type="text/css" />
</head>

<body>


    <?php include 'header.php'; ?>

    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <?php
                        $selected_shipping = 0;

                        if (isset($_POST['shipping_option'])) {
                            $selected_shipping = $_POST['shipping_option'];
                        }
                        if (isset($_SESSION["u"])) {

                            $email = $_SESSION["u"]["Email"];


                            $cart_rs = Database::search("SELECT DISTINCT product_details.Product_ID, product_details.Name,
                        cart.qty,cart.id,
                        product_details.price,product_details.Shipping_colombo,product_details.Shipping_outside_colombo, 
                        (SELECT Product_Image_Path 
                         FROM product_pics  
                         WHERE product_pics.Product_ID = product_details.Product_ID 
                         LIMIT 1) AS Product_Image_Path
                         
                          FROM  `cart`
                        INNER JOIN 
                            `product_details`  ON cart.Product_id = product_details.Product_ID
                        INNER JOIN 
                            `product_pics`  ON product_details.Product_ID = product_pics.Product_ID  
                        WHERE 
                        cart.users_email = '" . $email . "'");

                            $cart_num = $cart_rs->num_rows;


                        ?>
                            <div class="col align-self-center text-right text-muted fs-5"><?php echo ($cart_num); ?> items</div>
                    </div>
                </div>
                <?php
                            if ($cart_num == 0) {
                ?>

                    <span class="h1 text-black-50 fw-bold offset-lg-4  offset-sm-4">
                        <i class="bi bi-cart-plus" style="font-size: 200px;"></i>
                    </span>

                    <div class="text-right offset-lg-2" style="font-size: 50px; font-family: Comic Sans MS, Comic Sans, cursive; font-weight: bold; font-style: italic;">Add items to your cart...</div>



                <?php
                            }

                            $total = 0;

                            for ($x = 0; $x < $cart_num; $x++) {
                                $cart_data = $cart_rs->fetch_assoc();



                ?>
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">



                            <div class="col-2"><img class="product_img img-fluid" src="<?php echo $cart_data["Product_Image_Path"] ?>"></div>
                            <div class="col">
                                <div class="row text-muted"><?php echo $cart_data["Name"]; ?></div>

                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-danger" onclick='removefromcart(<?php echo $cart_data["Product_ID"] ?>);'><i class="bi bi-dash"></i></a>

                                <?php echo $cart_data["qty"]; ?>
                                <a href="#" class="btn btn-primary" onclick='addtocart(<?php echo $cart_data["Product_ID"] ?>);'><i class="bi bi-plus"></i></a>
                            </div>
                            <div class="col">Rs. <?php echo $cart_data["price"]; ?></div>


                        </div>
                    </div>
                <?php
                                $total = $total + ($cart_data["price"] * $cart_data["qty"]);
                            }
                        } else {

                ?>

                <td colspan="5" class="text-center text-white-50 fw-bold"><a href="signup.php">Sign In<a></a> to Your Account First</td>

            <?php
                        }
            ?>


            <div class="back-to-shop"><a href="index.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <?php
                if (isset($_SESSION["u"])) {
                ?>
                    <div class="row">
                        <div class="col" style="padding-left:2;"><?php echo ($cart_num); ?> items</div>
                        <div class="col text-right">Rs. <?php echo ($total); ?>.00</div>
                    </div>
                    <form method="POST" action="" class="form1">
                        <p>SHIPPING</p>
                        <select class="selectdelivery" name="shipping_option" onchange="this.form.submit();">
                            <?php if (isset($cart_data)) { ?>
                                <option value="<?php echo $cart_data["Shipping_colombo"]; ?>" <?php if ($selected_shipping == $cart_data["Shipping_colombo"]) echo 'selected'; ?>>
                                    Colombo: Rs. <?php echo $cart_data["Shipping_colombo"]; ?>
                                </option>
                                <option value="<?php echo $cart_data["Shipping_outside_colombo"]; ?>" <?php if ($selected_shipping == $cart_data["Shipping_outside_colombo"]) echo 'selected'; ?>>
                                    Outside Colombo: Rs. <?php echo $cart_data["Shipping_outside_colombo"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <p>GIVE CODE</p>
                        <input class="input1" id="code" placeholder="Enter your code">
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>

                        <div class="col text-right">Rs.<?php echo ($total + $selected_shipping); ?>.00</div>
                    </div>
                    <button class="btn btn-secondary col-12 mt-3">CHECKOUT</button>



                <?php
                } else {
                    $cart_num=0;
                    $total=0;
                ?>

                    <div class="row">
                        <div class="col" style="padding-left:2;"><?php echo ($cart_num); ?> items</div>
                        <div class="col text-right">Rs. <?php echo ($total); ?>.00</div>
                    </div>
                    <form method="POST" action="" class="form1">
                        <p>SHIPPING</p>
                        <select class="selectdelivery" name="shipping_option" onchange="this.form.submit();">
                            <?php if (isset($cart_data)) { ?>
                                <option value="<?php echo $cart_data["Shipping_colombo"]; ?>" <?php if ($selected_shipping == $cart_data["Shipping_colombo"]) echo 'selected'; ?>>
                                    Colombo: Rs. <?php echo $cart_data["Shipping_colombo"]; ?>
                                </option>
                                <option value="<?php echo $cart_data["Shipping_outside_colombo"]; ?>" <?php if ($selected_shipping == $cart_data["Shipping_outside_colombo"]) echo 'selected'; ?>>
                                    Outside Colombo: Rs. <?php echo $cart_data["Shipping_outside_colombo"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <p>GIVE CODE</p>
                        <input class="input1" id="code" placeholder="Enter your code">
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>

                        <div class="col text-right">Rs.<?php echo ($total + $selected_shipping); ?>.00</div>
                    </div>
                    <button class="btn btn-secondary col-12 mt-3">CHECKOUT</button>



                <?php
                }
                ?>


            </div>
        </div>

    </div>
    <!--watchlist-->
    <div class="offcanvas offcanvas-end  text-bg-dark" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Watchlist
                <i class="bi bi-bookmark-heart-fill"></i>
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>

                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">item image</th>
                            <th scope="col">item name</th>
                            <th scope="col">price</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($_SESSION["u"])) {

                            $email = $_SESSION["u"]["Email"];
                        ?><?php

                            $watchlist_rs = Database::search("SELECT DISTINCT product_details.Product_ID, product_details.Name,
                        product_details.QTY, 
                        product_details.price, 
                        (SELECT Product_Image_Path 
                         FROM product_pics  
                         WHERE product_pics.Product_ID = product_details.Product_ID 
                         LIMIT 1) AS Product_Image_Path
                         
                          FROM  `watchlist`
                        INNER JOIN 
                            `product_details`  ON watchlist.Product_id = product_details.Product_ID
                        INNER JOIN 
                            `product_pics`  ON product_details.Product_ID = product_pics.Product_ID  
                        WHERE 
                        watchlist.user_email = '" . $email . "'");

                            $watchlist_num = $watchlist_rs->num_rows;
                            for ($x = 0; $x < $watchlist_num; $x++) {
                                $watchlist_data = $watchlist_rs->fetch_assoc();

                            ?>
                        <tr>
                            <th scope="row"><?php echo $watchlist_data["Product_ID"]; ?></th>
                            <td><img src="<?php echo $watchlist_data["Product_Image_Path"] ?>" class="cato-img  " alt="..."></td>

                            <td><?php echo $watchlist_data["Name"]; ?></td>

                            <td><?php echo $watchlist_data["price"]; ?></td>

                            <td>
                                <div class="row m-1 ">
                                    <?php

                                    if ($watchlist_data["QTY"] > 0) {
                                    ?>
                                        <button class="col btn btn-primary m-1" onclick='addtocart(<?php echo $watchlist_data["Product_ID"] ?>);'><i class="bi bi-bag-plus"></i></button>

                                    <?php

                                    } else {
                                    ?>
                                        <button class="col btn btn-primary m-1 d-none">Add to Cart</button>
                                    <?php
                                    }


                                    ?>

                                    <button class="col btn btn-danger m-1 " onclick='addwatchlist(<?php echo $watchlist_data["Product_ID"] ?>);'><i class="bi bi-x-square-fill"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>

                    <td colspan="5" class="text-center text-white-50 fw-bold"><a href="signup.php">Sign In</a> to Your Account First</td>

                <?php
                        }
                ?>


                    </tbody>
                </table>
            </div>

        </div>
    </div>





    <script src="script.js"></script>
</body>

</html>