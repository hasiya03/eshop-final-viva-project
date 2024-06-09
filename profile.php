<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Tech| User Profile</title>
   
  <link rel="icon" href="pics/new tech custom logo.png" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">




</head>

<body>
    <?php include "header.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <?php
            include "connection.php";

            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["Email"];

                $details_rs = Database::search("SELECT * FROM `customer_details` INNER JOIN `gender` ON  
                                                customer_details.Gender_Gender_id=Gender_id WHERE `Email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_pics` WHERE `Customer_details_Email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `customer_address` INNER JOIN `city` ON  
                                                customer_address.City_City_Id=city.City_Id INNER JOIN 
                                                `district` ON city.District_District_id=district.District_id
                                                INNER JOIN `province` ON 
                                                district.Province_Province_id=province.Province_id
                                                WHERE `Customer_details_Email`='" . $email . "'");

                $user_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();
            ?>

                <div class="col-12 bg-secondary">
                    <div class="row">
                        

                        <div class="col-12 bg-body mt-4 mb-4">
                            <div class="row g-2">
                                 <div class="d-flex justify-content-center align-items-center">
                                            <h4 class="fw-bold">User Profile</h4>
                                        </div>


                                <div class="col-md-3 col-lg-12 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <?php
                                        if (empty($image_data["Image_path"])) {
                                        ?>
                                            <img src="" alt="profile image" class="profile_img" />
                                        <?php

                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["Image_path"]; ?>" alt="profile image" class="profile_img" />

                                        <?php

                                        }


                                        ?>
                                        <span class="fw-bold"><?php echo $user_data["Email"]; ?></span>
                                        


                                        <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-primary mt-5" onclick="changeprofilepic();">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-5 col-lg-9 offset-lg-2 ">
                                    <div class="">

                                       
                                        <div class="row mt-4">



                                            <div class="col-12">
                                                <label class="form-label">Name</label>
                                                <input type="text" id="Name" class="form-control" value="<?php echo $user_data["Name"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" id="mobile" class="form-control" value="<?php echo $user_data["Mobile_No"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="pw" value="<?php echo $user_data["Password"]; ?>" class="form-control" aria-describedby="pwb">
                                                    <span class="input-group-text" id="pwb"><i class="bi bi-eye-fill"></i></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" id="email" class="form-control" value="<?php echo $user_data["Email"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $user_data["Registerd_Date"]; ?>" />
                                            </div>


                                            <?php

                                            if (empty($address_data["First_Line"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="line1" class="form-control" value="<?php echo $address_data["First_Line"]; ?>" />
                                                </div>
                                            <?php
                                            }

                                            if (empty($address_data["Second_Line"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="line2" class="form-control" value="<?php echo $address_data["Second_Line"]; ?>" />
                                                </div>
                                            <?php
                                            }

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            $province_num = $province_rs->num_rows;
                                            $district_num = $district_rs->num_rows;
                                            $city_num = $city_rs->num_rows;

                                            ?>



                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php

                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["Province_Name"]; ?>" <?php
                                                                                                                        if (!empty($address_data["Province_Province_id"])) {
                                                                                                                            if ($province_data["Province_id"] == $address_data["Province_Province_id"]) {
                                                                                                                        ?> selected <?php
                                                                                                                                }
                                                                                                                            }
                                                                                                                                    ?>><?php echo $province_data["Province_Name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>



                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php

                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["District_name"]; ?>" <?php
                                                                                                                        if (!empty($address_data["District_District_id"])) {
                                                                                                                            if ($district_data["District_id"] == $address_data["District_District_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            }
                                                                                                                                    ?>>
                                                            <?php echo $district_data["District_name"] ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City </option>
                                                    <?php

                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["City_Id"]; ?>" <?php
                                                                                                                if (!empty($address_data["City_City_Id"])) {
                                                                                                                    if ($city_data["City_Id"] == $address_data["City_City_Id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>>
                                                            <?php echo $city_data["City_Name"] ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <?php

                                            if (empty($address_data["ZIP_code"])) {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text"  id="zip" class="form-control" placeholder="Enter Your Postal Code" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="zip" class="form-control" value="<?php echo $address_data["ZIP_code"]; ?>" />
                                                </div>
                                            <?php
                                            }

                                            ?>





                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $user_data["gender_name"]; ?>" />
                                            </div>

                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-primary" onclick="updateprofile();">Update My Profile</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 text-center">
                                    <div class="row">

                                        <span class="fw-bold text-black-50 mt-5 h1 offset-lg-5 profiletext-caption ">Recently purchased Items</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>





            <?php
            } else {

            ?>
                <script>
                    window.location = "signup.php";
                </script>


            <?php

            }
            ?>











        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="script.js"></script>
</body>

</html>