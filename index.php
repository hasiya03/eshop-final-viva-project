<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        New Tech||Homepage
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include "header.php"; ?>
    <!--corousal-->
    <div class="container ">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="pics/corousal/dd_environment_trade_in__ffgz1k6741e2_large_2x.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption  d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="pics/corousal/Lotus Flower Theme KeyCap Set, OEM Profile PBT Subdye Keycap, Ink Painting Theme Gaming Mechanical Keyboard Keycap, Black Artisan Keycaps.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption  d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="pics/corousal/SDSAC-7339-S24U-Exclusive-Colors-HP-KV-DT-1440x640.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption  d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!--corousal-->
    <!--catergory-->
    <div class="container text-bg-dark p-2 fs-4 text-center my-2">categories </div>



    <div class="container text-center">
        <div class="row align-items-start">

            <?php
            $cat_rs = Database::search("SELECT* FROM `catergory`");
            $cat_num = $cat_rs->num_rows;

            for ($i = 0; $i < $cat_num; $i++) {
                $cat_data = $cat_rs->fetch_assoc();
            ?>
                <div class="col">
                    <img src="<?php echo $cat_data["cat_pic"] ?>" class="cato-img  " alt="...">
                    <p><?php echo $cat_data["Name"] ?></p>
                </div>


            <?php

            }


            ?>


        </div>
    </div>






    <!--catergory-->
    <div id="basicSearchResult">
        <div class=" container text-bg-secondary p-3 fs-4 mb-2 text-center">All Products</div>
        <!--products-->
        <div class="container ">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2">

                <?php
                $prod_rs = Database::search("SELECT * FROM `product_details`");
                $prod_num = $prod_rs->num_rows;

                for ($w = 0; $w < $prod_num; $w++) {
                    $prod_data = $prod_rs->fetch_assoc();
                ?>
                    <div class="col ">
                        <div class="card h-100" style="width: 20rem;">
                            <?php

                            $img_rs = Database::search("SELECT * FROM `product_pics` WHERE `Product_ID`='" . $prod_data['Product_ID'] . "'");
                            $img_data = $img_rs->fetch_assoc();

                            ?>
                            <img src="<?php echo $img_data["Product_Image_Path"] ?>" class=" card-img-top " style="height: 70%;" alt="product image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $prod_data["Name"] ?></h5>
                                <p class="card-text"><?php echo $prod_data["Product_description"] ?></p>

                                <?php
 
                                if ($prod_data["QTY"] > 0) {

                                ?>
                                    <span class="card-text text-success fw-bold">In Stock</span></br>
                                    <a href="<?php echo "productpage.php?id=" . ($prod_data["Product_ID"]); ?>" class="btn btn-primary">BUY NOW</a>
                                    
                                    <?php
                                    if (isset($_SESSION["u"])) {
                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `Product_id`='" . $prod_data["Product_ID"] . "' AND `user_email`='" . $_SESSION["u"]["Email"] . "'");
                                        $watchlist_num = $watchlist_rs->num_rows;
                                        if ($watchlist_num == 1) {
                                    ?>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $prod_data["Product_ID"] ?>);' id="<?php echo $prod_data["Product_ID"] ?>">ADDED TO WISHLIST</a>

                                        <?php
                                        } else {
                                        ?>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $prod_data["Product_ID"] ?>);' id="<?php echo $prod_data["Product_ID"] ?>">ADD TO WISHLIST</a>

                                        <?php
                                        }
                                        ?>
                                        <a href="#" class="btn btn-primary"onclick='addtocart(<?php echo $prod_data["Product_ID"] ?>);'>ADD TO CART</a>
                                    <?php
                                    } else {


                                    ?>
                                        <a href="#" class="btn btn-primary"onclick="showAlert()">ADD TO CART</a>

                                        <a href="#" class="btn btn-primary" onclick="showAlert()" >ADD TO WISHLIST</a>
                                        <script>
                                            function showAlert() {
                                                Swal.fire({
                title: 'Alert',
                text: 'Please Sign in first!',
                icon: 'info',
                confirmButtonText: 'OK'
            });
                                            }
                                        </script>


                                    <?php

                                    }
                                    ?>




                                <?php 

                                } else {
                                ?>
                                    <span class="card-text text-danger fw-bold">Out of  Stock</span></br>
                                    
                                    <?php
                                    if (isset($_SESSION["u"])) {
                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `Product_id`='" . $prod_data["Product_ID"] . "' AND `user_email`='" . $_SESSION["u"]["Email"] . "'");
                                        $watchlist_num = $watchlist_rs->num_rows;
                                        if ($watchlist_num == 1) {
                                    ?>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $prod_data["Product_ID"] ?>);' id="<?php echo $prod_data["Product_ID"] ?>">ADDED TO WISHLIST</a>

                                        <?php
                                        } else {
                                        ?>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $prod_data["Product_ID"] ?>);' id="<?php echo $prod_data["Product_ID"] ?>">ADD TO WISHLIST</a>

                                        <?php
                                        }
                                        ?>
                                    <?php
                                    } else {


                                    ?>
                                        <a href="#" class="btn btn-primary" onclick="showAlert()" ?>ADD TO WISHLIST</a>
                                        <script>
                                            function showAlert() {
                                               
              Swal.fire({
                title: 'Alert',
                text: 'Please Sign in first!',
                icon: 'info',
                confirmButtonText: 'OK'
            });
                                            }
                                        </script>


                                    <?php

                                    }
                                    ?>


                               


                               <?php


                                }

                                ?>

                            </div>
                        </div>
                    </div>

                <?php
                }

                ?>




            </div>

        </div>

        <!--paginations-->
        <?php

        $pageno = 1;
        $product_rs = Database::search("SELECT* FROM `product_details`");
        $product_num = $product_rs->num_rows;


        $results_per_page = 2;
        $number_of_pages = ceil($product_num / $results_per_page);





        ?>

    </div>
    <!--offcanvas-->

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

                    <td colspan="5" class="text-center text-white-50 fw-bold"><a href="signup.php">Sign In<a></a> to Your Account First</td>

                <?php
                        }
                ?>


                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!--offcanvas-->









    <?php include "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="script.js"></script>


</body>

</html>