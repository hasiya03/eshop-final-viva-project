<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        New Tech||Product Adding
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>


    <?php

    session_start();

    include "adminheader.php";

    if (isset($_SESSION["u"])) {

        include "connection.php";


    ?>


        <h3 class="text-center p-3">Add Product</h3>

        <div class=" row">
            <div class="col-12">
                <div class="row">
                    
                    <div class="offset-lg-3 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-4 border border-black rounded-start">
                                <img src="pics/icons8-add-product-96(-xxhdpi).png" class="img-fluid" style="width: 250px;" id="prodpic0" />
                            </div>
                            <div class="col-4 border border-black ">
                                <img src="pics/icons8-add-product-96(-xxhdpi).png" class="img-fluid" style="width: 250px;" id="prodpic1" />
                            </div>
                            <div class="col-4 border border-black rounded-end">
                                <img src="pics/icons8-add-product-96(-xxhdpi).png" class="img-fluid" style="width: 250px;" id="prodpic2" />
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
                        <label for="productname" class="form-label">Product Name</label>
                        <input class="form-control" id="productname">
                    </div>
                    <div class="col-md-12">
                        <label for="Category" class="form-label">Category</label>
                        <select id="Category" class="form-select" onclick="loadBrands();">
                            <option value="0">Select category</option>
                            <?php



                            $category_rs = Database::search("SELECT * FROM `catergory`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $category_data["Catergory_id"]; ?>"><?php echo $category_data["Name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <select id="brand" class="form-select">
                            <option value="0">Select Brand</option>
                            <?php



                            $brand_rs = Database::search("SELECT * FROM `brand`");
                            $brand_num = $brand_rs->num_rows;

                            for ($x = 0; $x < $brand_num; $x++) {
                                $brand_data = $brand_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $brand_data["Brand_id"]; ?>"><?php echo $brand_data["Brand_Name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="model" class="form-label">Model</label>
                        <select id="model" class="form-select">
                            <option value="0">Select Model</option>
                            <?php



                            $model_rs = Database::search("SELECT * FROM `models`");
                            $model_num = $model_rs->num_rows;

                            for ($x = 0; $x < $model_num; $x++) {
                                $model_data = $model_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $model_data["Models_id"]; ?>"><?php echo $model_data["Model_Name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="color" class="form-label">Color</label>
                        <select id="Color" class="form-select">
                            <option value="0">Select color</option>
                            <?php



                            $color_rs = Database::search("SELECT * FROM `color`");
                            $color_num = $color_rs->num_rows;

                            for ($x = 0; $x < $color_num; $x++) {
                                $color_data = $color_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $color_data["Color_id"]; ?>"><?php echo $color_data["Color_Name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="Storage" class="form-label">Storage</label>
                        <select id="Storage" class="form-select">
                            <option value="0">Select Storage</option>
                            <?php



                            $storage_rs = Database::search("SELECT * FROM `storage`");
                            $storage_num = $storage_rs->num_rows;

                            for ($x = 0; $x < $storage_num; $x++) {
                                $storage_data = $storage_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $storage_data["Storage_id"]; ?>"><?php echo $storage_data["Amount"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ">Quantity</label>


                        <input type="number" class="form-control" id="Qty" />

                    </div>

                    <div class="col-md-6">
                        <label for="inputCondition" class="form-label"> Product Condition</label>
                        <select id="inputCondition" class="form-select">
                            <option value="0">Select Condition</option>
                            <?php



                            $condition_rs = Database::search("SELECT * FROM `condition`");
                            $condition_num = $condition_rs->num_rows;

                            for ($x = 0; $x < $condition_num; $x++) {
                                $condition_data = $condition_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $condition_data["Condition_id"]; ?>"><?php echo $condition_data["Condition_type"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="Description" class="form-label">Description</label>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="" id="Description" style="height: 100px"></textarea>
                            <label for="floatingTextarea2Disabled"></label>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <label class="form-label ">Delivery in colombo</label>

                        <div class="input-group mb-2 ">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" id="decolo" />
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label ">Delivery out of colombo</label>

                        <div class="input-group mb-2 ">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" id="deoutcolo" />
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label ">Price</label>

                        <div class="input-group mb-2 ">
                            <span class="input-group-text">Rs.</span>
                            <input type="text" class="form-control" id="price" />
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                    <div class="col-md-12 d-grid py-4 ">
                        <button type="submit" class="btn  btn-primary" onclick="listproduct();">List Product</button>
                    </div>
                </form>


            </div>

        </div>
    <?php
    } else {



        header("Location:index.php");
    }

    ?>







    <script src="script.js"></script>
</body>

</html>