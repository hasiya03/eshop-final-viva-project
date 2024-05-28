<?php
session_start();
require "connection.php";

$text = $_POST["t"];

$query = "SELECT * FROM `product_details`";

if (!empty($text)) {

    $query .= " WHERE `Name` LIKE '%" . $text . "%'";
}

?>
<div id="basicSearchResult">
    <div class="container text-bg-secondary p-3 fs-4 mb-2 text-center ">Search results || <a class="link-dark link-offset-2 link-underline-opacity-100-hover link-underline-opacity-0 " href="advancedsearch.php">Advanced Search</a></div>
    <div class="">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2">



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

                    <div class="col">

                        <div class="card h-100" style="width: 20rem;">
                            <?php

                            $img_rs = Database::search("SELECT * FROM `product_pics` WHERE `Product_ID`='" . $selected_data['Product_ID'] . "'");
                            $img_data = $img_rs->fetch_assoc();

                            ?>
                            <img src="<?php echo $product_img_data["Product_Image_Path"] ?>" class=" card-img-top " style="height:400px" alt="product image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $selected_data["Name"] ?></h5>
                                <p class="card-text"><?php echo $selected_data["Product_description"] ?></p>

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
                                            <a href="<?php echo "productpage.php?id=" . ($selected_data["Product_ID"]); ?>" class="btn btn-primary">BUY NOW</a>

                                            <a href="#" class="btn btn-primary" onclick='addtocart(<?php echo $selected_data["Product_ID"] ?>);'>ADD TO CART</a>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $selected_data["Product_ID"] ?>);' id="<?php echo $selected_data["Product_ID"] ?>">ADDED TO WISHLIST</a>

                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?php echo "productpage.php?id=" . ($selected_data["Product_ID"]); ?>" class="btn btn-primary">BUY NOW</a>

                                            <a href="#" class="btn btn-primary" onclick='addtocart(<?php echo $selected_data["Product_ID"] ?>);'>ADD TO CART</a>
                                            <a href="#" class="btn btn-primary" onclick='addwatchlist(<?php echo $selected_data["Product_ID"] ?>);' id="<?php echo $selected_data["Product_ID"] ?>">ADD TO WISHLIST</a>

                                        <?php
                                        }
                                        ?>

                                    <?php
                                    } else {


                                    ?>
                                        <a href="#" class="btn btn-primary" onclick="showAlert()">ADD TO CART</a>

                                        <a href="#" class="btn btn-primary" onclick="showAlert()">ADD TO WISHLIST</a>
                                        <script>
                                            function showAlert() {
                                                alert("Please SignIn !");
                                            }
                                        </script>


                                    <?php

                                    }
                                    ?>
                                <?php

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
                                                alert("Please SignIn !");
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

        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-3 mb-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php

                    for ($y = 1; $y <= $number_of_pages; $y++) {
                        if ($y == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                            </li>
                    <?php
                        }
                    }

                    ?>

                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>