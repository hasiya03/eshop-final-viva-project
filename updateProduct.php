<?php

session_start();
require "connection.php";



if (isset($_SESSION["u"])) {

    if (isset($_SESSION["p"])) {
        $product = $_SESSION["p"];



?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                New Tech||Update Product
            </title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        </head>

        <body>

            <?php include "adminheader.php"; ?>


            <h3 class="text-center p-3">Update Product</h3>

            <div class=" row">
                <div class="col-12">
                    <div class="row">
                        <?php
                        $img = array();
                        $img[0] = "pics/icons8-add-product-96(-xxhdpi).png";
                        $img[1] = "pics/icons8-add-product-96(-xxhdpi).png";
                        $img[2] = "pics/icons8-add-product-96(-xxhdpi).png";
                        $img_rs = Database::search("SELECT * FROM `product_pics` WHERE `Product_pics_id`='" . $product["Product_ID"] . "'");
                        $img_num = $img_rs->num_rows;
                        for ($x = 0; $x < $img_num; $x++) {
                            $img_data = $img_rs->fetch_assoc();
                            $img[$x] = $img_data["Product_Image_Path"];
                        }
                        ?>


                        <div class="offset-lg-3 col-12 col-lg-6">
                            <div class="row">
                                <div class="col-4 border border-black rounded-start">
                                    <img src="<?php echo $img[0];?>" class="img-fluid" style="width: 250px;" id="prodpic0" />
                                </div>
                                <div class="col-4 border border-black ">
                                    <img src="<?php echo $img[1];?>" class="img-fluid" style="width: 250px;" id="prodpic1" />
                                </div>
                                <div class="col-4 border border-black rounded-end">
                                    <img src="<?php echo $img[2];?>" class="img-fluid" style="width: 250px;" id="prodpic2" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                    <input type="file" class="d-none" id="imageuploader" multiple />
                    <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                </div>

                <div class="container col-lg-7 mx-auto">

                    <form class="row g-3 p-2">


                        <div class="col-md-12">
                            <label for="t" class="form-label">Product Name</label>
                            <input class="form-control" value="<?php echo $product["Name"]; ?>" id="t">
                        </div>
                        <div class="col-md-12">
                            <label for="Category" class="form-label">Category</label>
                            <select class="form-select" disabled>
                                <?php

                                $category_rs = Database::search("SELECT * FROM `catergory` WHERE `Catergory_id`='" . $product["Catergory_Catergory_id"] . "'");
                                $category_data = $category_rs->fetch_assoc();
                                ?>
                                <option><?php echo $category_data["Name"]; ?></option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="brand" class="form-label">Brand</label>
                            <select id="brand" class="form-select" disabled>
                                <?php
                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `Brand_id` IN 
                                                                                (SELECT `Brand_Brand_id` FROM `models_has_brand` WHERE 
                                                                                `id`='" . $product["Models_has_Brand_Brand_Brand_id"] . "')");
                                $brand_data = $brand_rs->fetch_assoc();
                                ?>
                                <option><?php echo $brand_data["Brand_Name"]; ?></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label">Model</label>
                            <select id="model" class="form-select" disabled>

                                <?php
                                $model_rs = Database::search("SELECT * FROM `models` WHERE `Models_id` IN 
                                                                                (SELECT `Models_Models_id` FROM `models_has_brand` WHERE 
                                                                                `id`='" . $product["Models_has_Brand_Brand_Brand_id"] . "')");
                                $model_data = $model_rs->fetch_assoc();
                                ?>
                                <option><?php echo $model_data["Model_Name"]; ?></option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="color" class="form-label">Color</label>
                            <select id="Color" class="form-select" disabled>
                                <?php
                                $color_rs = Database::search("SELECT * FROM `color` WHERE `Color_id`='" . $product["color_Color_id"] . "'");
                                $color_data = $color_rs->fetch_assoc();
                                ?>
                                <option><?php echo $color_data["Color_Name"]; ?></option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="Storage" class="form-label">Storage</label>
                            <select id="Storage" class="form-select" disabled>
                                <?php
                                $storage_rs = Database::search("SELECT * FROM `storage` WHERE `Storage_id`='" . $product["storage_Storage_id"] . "'");
                                $storage_data = $storage_rs->fetch_assoc();
                                ?>
                                <option><?php echo $storage_data["Amount"]; ?></option>


                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label ">Quantity</label>


                            <input type="number" class="form-control" value="<?php echo $product["QTY"]; ?>" id="q" />

                        </div>

                        <div class="col-md-6">
                            <label for="inputCondition" class="form-label"> Product Condition</label>
                            <select id="inputCondition" class="form-select" disabled>
                                <?php
                                $condition_rs = Database::search("SELECT * FROM `condition` WHERE `Condition_id`='" . $product["Condition_Condition_id"] . "'");
                                $condition_data = $condition_rs->fetch_assoc();
                                ?>
                                <option><?php echo $condition_data["Condition_type"]; ?></option>

                            </select>
                        </div>
                        <div class="col-12">
                            <label for="Description" class="form-label">Description</label>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="" id="d" style="height: 100px"><?php echo $product["Product_description"]; ?></textarea>
                                <label for="floatingTextarea2Disabled"></label>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <label class="form-label ">Delivery in colombo</label>

                            <div class="input-group mb-2 ">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" value="<?php echo $product["Shipping_colombo"]; ?>" id="dwc" />
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label ">Delivery out of colombo</label>

                            <div class="input-group mb-2 ">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" value="<?php echo $product["Shipping_outside_colombo"]; ?>" id="doc" />
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label ">Price</label>

                            <div class="input-group mb-2 ">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" value="<?php echo $product["price"]; ?>" id="newprice" />
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>

                        <div class="col-md-12 d-grid py-4 ">
                            <button type="submit" class="btn  btn-primary" onclick="updateproduct();">Update Product</button>
                        </div>
                    </form>


                </div>

            </div>








            <script src="script.js"></script>
        </body>

        </html>
    <?php
    } else {
    ?>
        <script>
            alert("Please select a product.");
            window.location = "products.php";
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("You have to log in first");
        window.location = "signup.php";
    </script>
<?php
}

?>