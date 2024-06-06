<?php
session_start();

require "connection.php";


$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["mo"];
$condition = $_POST["con"];
$color = $_POST["col"];
$from = $_POST["pf"];
$to = $_POST["pt"];

$query = "SELECT * FROM `product_details`";
$status = 0;


    if ($category != 0 && $status == 0) {
        $query .= " WHERE `Catergory_Catergory_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `Catergory_Catergory_id`='" . $category . "'";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $modelHasBrand_rs = Database::search("SELECT * FROM `models_has_brand` WHERE 
                                                `Brand_Brand_id`='" . $brand . "'");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for ($x = 0; $x < $modelHasBrand_num; $x++) {
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `Models_has_Brand_Brand_Brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `Models_has_Brand_Brand_Brand_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {

        $modelHasBrand_rs = Database::search("SELECT * FROM `models_has_brand` WHERE 
                                                `Models_Models_id`='" . $model . "'");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for ($x = 0; $x < $modelHasBrand_num; $x++) {
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `Models_has_Brand_Brand_Brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `Models_has_Brand_Brand_Brand_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $model != 0) {

        $modelHasBrand_rs = Database::search("SELECT * FROM `models_has_brand` WHERE 
                        `Models_Models_id`='" . $model . "' AND `Brand_Brand_id`='" . $brand . "'");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for ($x = 0; $x < $modelHasBrand_num; $x++) {
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `Models_has_Brand_Brand_Brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `Models_has_Brand_Brand_Brand_id`='" . $pid . "'";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `Condition_Condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `Condition_Condition_id`='" . $condition . "'";
    }

    if ($color != 0 && $status == 0) {
        $query .= " WHERE `color_Color_id`='" . $color . "'";
        $status = 1;
    } else if ($color != 0 && $status != 0) {
        $query .= " AND `color_Color_id`='" . $color . "'";
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $from . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $from . "'";
        }
    } else if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $to . "'";
        }
    } else if (!empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $from . "' AND '" . $to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $from . "' AND '" . $to . "'";
        }
    }


?> 

<div class="" id="view_area">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row g-2 justify-content-center">

            <?php

            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 4;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " 
                                            OFFSET " . $page_results . " ");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_pics` WHERE 
                                                    `Product_ID`='" . $selected_data["Product_ID"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

            ?>

                <div class="card h-100 m-1" style="width: 18rem;">

                    <img src="<?php echo $product_img_data["Product_Image_Path"]; ?>" class=" card-img-top " style="height: 250px;" alt="product image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $selected_data["Name"]; ?></h5>
                        <span class="badge rounded-pill text-bg-info">New</span><br />
                        <span class="card-text text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                        <span class="card-text text-success fw-bold"><?php echo $selected_data["QTY"]; ?> Items Available</span><br />

                        <?php
                        if ($selected_data["QTY"] > 0) {
                        ?>
                            <span class="card-text text-success fw-bold">In Stock</span></br>
                            <?php
                                    if (isset($_SESSION["u"])) {
                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `Product_id`='" . $selected_data["Product_ID"] . "' AND `user_email`='" . $_SESSION["u"]["Email"] . "'");
                                        $watchlist_num = $watchlist_rs->num_rows;
                                        if ($watchlist_num == 1) {
                                    ?>
                                           <div class="row g-2">
                                           <a href="<?php echo "productpage.php?id=" . ($selected_data["Product_ID"]); ?>" class="btn btn-primary">BUY NOW</a>

                                            <a href="#" class="btn btn-primary" onclick='addtocart(<?php echo $selected_data["Product_ID"] ?>);'>ADD TO CART</a>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $selected_data["Product_ID"] ?>);' id="<?php echo $selected_data["Product_ID"] ?>">ADDED TO WISHLIST</a>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                           <div class="row g-2">

                                            <a href="<?php echo "productpage.php?id=" . ($selected_data["Product_ID"]); ?>" class="btn btn-primary">BUY NOW</a>

                                            <a href="#" class="btn btn-primary" onclick='addtocart(<?php echo $selected_data["Product_ID"] ?>);'>ADD TO CART</a>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $selected_data["Product_ID"] ?>);' id="<?php echo $selected_data["Product_ID"] ?>">ADD TO WISHLIST</a>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    <?php
                                    } else {


                                    ?>
                                    <div class="row g-1">
                                            <a href="<?php echo "productpage.php?id=" . ($selected_data["Product_ID"]); ?>" class="btn btn-primary">BUY NOW</a>

                                        <a href="#" class="btn btn-primary" onclick="showAlert()">ADD TO CART</a>

                                        <a href="#" class="btn btn-primary" onclick="showAlert()">ADD TO WISHLIST</a>
                                        </div>
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
///////////////////////////////////////////////////
                        } else {
                        ?>
                            <span class="card-text text-danger fw-bold">Out of Stock</span></br>

                           <?php
                                    if (isset($_SESSION["u"])) {
                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `Product_id`='" . $selected_data["Product_ID"] . "' AND `user_email`='" . $_SESSION["u"]["Email"] . "'");
                                        $watchlist_num = $watchlist_rs->num_rows;
                                        if ($watchlist_num == 1) {
                                    ?>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $selected_data["Product_ID"] ?>);' id="<?php echo $selected_data["Product_ID"] ?>">ADDED TO WISHLIST</a>

                                        <?php
                                        } else {
                                        ?>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $selected_data["Product_ID"] ?>);' id="<?php echo $selected_data["Product_ID"] ?>">ADD TO WISHLIST</a>

                                        <?php
                                        }
                                        ?>
                                    <?php
                                    } else {


                                    ?>
                                        <a href="#" class="btn btn-primary" onclick="showAlert()" ?>ADD TO WISHLIST</a>
                                        <script>
                                            function showAlert() {
                                            
                                            }
                                        </script>


                                    <?php

                                    }
                                    ?>

                        <?php


                        }

                        ?>

                    </div>
                    </div> <?php
                    }

                        ?> 
                        </div>
        </div>

        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-3 mb-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="advancedSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                        } ?> aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php

                    for ($y = 1; $y <= $number_of_pages; $y++) {
                        if ($y == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                            </li>
                    <?php
                        }
                    }

                    ?>

                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="advancedSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                        } ?> aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>