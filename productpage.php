<?php

include "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];



    $product_rs = Database::search("SELECT product_details.Product_ID,product_details.price,product_details.QTY,product_details.Product_description,product_details.storage_Storage_id,
    product_details.Name,product_details.Listing_date,product_details.Shipping_colombo,product_details.Shipping_outside_colombo,
    product_details.Catergory_Catergory_id,product_details.Models_has_Brand_Brand_Brand_id,product_details.color_Color_id,product_details.status_status_id,
    product_details.Condition_Condition_id,product_details.Customer_details_Email,models.Model_Name AS mname,
    brand.Brand_Name AS bname FROM `product_details` INNER JOIN `models_has_brand` ON 
    models_has_brand.id=product_details.Models_has_Brand_Brand_Brand_id INNER JOIN `brand` ON 
    brand.Brand_id=models_has_brand.Brand_Brand_id INNER JOIN `models` ON 
    models.Models_id=models_has_brand.Models_Models_id WHERE product_details.Product_ID='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();


?>
        <!DOCTYPE html>

        <html>

        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>New Tech|Product View|<?php echo $product_data["Name"]; ?></title>

            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">




        </head>

        <body>
            <?php include "header.php"; ?>

            <div class=" row  mx-auto">
                <!--product pic corousal -->
                <div class="mx-auto col-lg-4">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_pics` WHERE `Product_ID`='" . $pid . "'");
                            $img_num = $img_rs->num_rows;
                            $img_list = array();

                            if ($img_num != 0) {
                                for ($x = 0; $x < $img_num; $x++) {
                                    $img_data = $img_rs->fetch_assoc();
                                    $img_list[$x] = $img_data["Product_Image_Path"];
                            ?>
                                    <div class="carousel-item active">
                                        <img src="<?php echo $img_list[$x]; ?>" class="d-block w-100" alt="...">
                                        <div class="carousel-caption  d-md-block">

                                        </div>
                                    </div>
                                <?php

                                }
                            } else {
                                ?>
                                <div class="carousel-item active">
                                    <img src="pics/icons8-add-product-96(-xxhdpi).png" class="d-block w-100" alt="...">
                                    <div class="carousel-caption  d-md-block">

                                    </div>
                                </div>
                                <div class="carousel-item ">
                                    <img src="pics/icons8-add-product-96(-xxhdpi).png" class="d-block w-100" alt="...">
                                    <div class="carousel-caption  d-md-block">

                                    </div>
                                </div>
                                <div class="carousel-item ">
                                    <img src="pics/icons8-add-product-96(-xxhdpi).png" class="d-block w-100" alt="...">
                                    <div class="carousel-caption  d-md-block">

                                    </div>
                                </div>
                            <?php
                            }

                            ?>



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
                <!--product pic corousal -->
                <div class="container col-lg-8 ">
                    <div class="row border-bottom border-dark">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item ">Home</li>
                                <li class="breadcrumb-item ">Products</li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $product_data["Name"]; ?></li>
                            </ol>
                        </nav>
                    </div>

                    <div class=" card text-bg-secondary mt-2">
                        <div class="card-body">
                        
                            <p><?php echo  $product_data["Product_description"];  ?></p>
                            <div class="col-12 my-2">
                                                        <span class="fs-6"><b>Warrenty : </b>6 Months Warranty</span><br />
                                                        <span class="fs-6"><b>Return Policy : </b>1 Months Return Policy</span><br />
                                                        <span class="fs-6"><b>In Stock : </b><?php echo $product_data["QTY"]; ?> Items Available</span>
                                                    </div>
                            <span class="fs-4 text-dark fw-bold">Rs. <?php echo  $product_data["price"];  ?> .00</span>
                            <div>
                                <?php
                                $clr_rs = Database::search("SELECT * FROM`color` WHERE `Color_id`='" . $product_data["color_Color_id"] . "'");
                                $color_data = $clr_rs->fetch_assoc();

                                ?>


                                <P class="">COLOR:</P>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <?php echo $color_data["Color_Name"]; ?>
                                    </label>
                                </div>
                                <?php
                                $clr_rs = Database::search("SELECT * FROM`color` WHERE `Color_id`<>'" . $product_data["color_Color_id"] . "'");
                                $color_rows = $clr_rs->num_rows;
                               
                                for($x=0;$x< $color_rows; $x++){
                                    $color_data = $clr_rs->fetch_assoc();

                                ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
                                    <label class="form-check-label" for="flexRadioDisabled">
                                       <?php echo $color_data["Color_Name"];?>
                                    </label>
                                </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div>
                            <?php
                                $str_rs = Database::search("SELECT * FROM`storage` WHERE `Storage_id`='" . $product_data["storage_Storage_id"] . "'");
                                $str_data = $str_rs->fetch_assoc();

                                ?>


                                <P class="">Storage:</P>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <?php echo $str_data["Amount"]; ?>
                                    </label>
                                </div>
                                <?php
                                $str_rs = Database::search("SELECT * FROM`storage` WHERE `Storage_id`<>'" . $product_data["storage_Storage_id"] . "'");
                                $str_rows = $str_rs->num_rows;
                               
                                for($x=0;$x< $str_rows; $x++){
                                    $str_data = $str_rs->fetch_assoc();

                                ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled2" id="flexRadioDisabled2" disabled>
                                    <label class="form-check-label" for="flexRadioDisabled2">
                                       <?php echo $str_data["Amount"];?>
                                    </label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <button class="btn btn-secondary col-12 mt-3" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Buy now</button>

                </div>

            </div>

            <div class="m-2">

                <div class="card text-center  border-secondary">
                    <div class="card-header mx-auto">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="#"> Product details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="false" href="#">Reviews</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
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
            <script src="script.js"></script>
          


        </body>

        </html>
    <?php

    } else {
    ?> <script>
            alert("Something went wrong");
        </script> <?php
                }
            }


                    ?>