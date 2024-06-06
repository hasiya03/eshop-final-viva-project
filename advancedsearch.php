<?php

require "connection.php";



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Tech||Advanced Search Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<?php include "header.php"; ?>

<body class="bg-info">

    <div class="container-fluid">
        <div class="row">





            <div class=" col-11 col-lg-2 mx-3 my-4  border border-black rounded">
                


                       

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-12 mb-1 mt-3">
                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $category_rs = Database::search("SELECT * FROM `catergory`");
                                            $category_num = $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $category_data["Catergory_id"] ?>"><?php echo $category_data["Name"] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-12 mb-1 mt-3">
                                        <select class="form-select" id="b1">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($x = 0; $x < $brand_num; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand_data["Brand_id"] ?>"><?php echo $brand_data["Brand_Name"] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-12 mb-3 mt-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $model_rs = Database::search("SELECT * FROM `models`");
                                            $model_num = $model_rs->num_rows;

                                            for ($x = 0; $x < $model_num; $x++) {
                                                $model_data = $model_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $model_data["Models_id"] ?>"><?php echo $model_data["Model_Name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-12 mb-3">
                                        <select class="form-select" id="c2">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($x = 0; $x < $condition_num; $x++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $condition_data["Condition_id"] ?>"><?php echo $condition_data["Condition_type"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-12 mb-3">
                                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $color_rs = Database::search("SELECT * FROM `color`");
                                            $color_num = $color_rs->num_rows;

                                            for ($x = 0; $x < $color_num; $x++) {
                                                $color_data = $color_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color_data["Color_id"] ?>"><?php echo $color_data["Color_Name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                   
                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Price To..." id="pt" />

                                        </div>
                                  

                                    <div class="col-6   mb-3 d-grid">
                                        <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                                    </div>
                                    <div class="col-6   mb-3 d-grid">
                                        <button class="btn btn-danger" onclick="clearSort();">Clear Sort</button>
                                    </div>


                                </div>
                            </div>

                      
                    

                
            </div>

            <div class="  col-12 col-lg-9 bg-body rounded mb-3 mt-4">
                

                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">Search for the any Item you want </span>
                            </div>
                        </div>
                    </div>
                </div>
                
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

    <?php include "footer.php"; ?>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
   
    <script src="script.js"></script>
</body>

</html>