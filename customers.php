<?php
include "connection.php";
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        New Tech||Customer Details
    </title>
  <link rel="icon" href="pics/new tech custom logo.png" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include "adminheader.php"; ?>
    <h2 class="text-center">Customers</h2>
    <div class="table-responsive">
        <div class="container">
            <table class="table table-hover table-secondary table-striped mt-2 p-2 rounded">

                <thead>
                    <tr>
                        <th scope="col">Profile Pics</th>

                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $customer_rs = Database::search("SELECT * FROM `customer_details`");
                    $customer_num = $customer_rs->num_rows;

                    $results_per_page = 10;
                    $number_of_pages = ceil($customer_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;



                    for ($x = 0; $x < $customer_num; $x++) {
                        $customer_data = $customer_rs->fetch_assoc();

                    ?>
                        <tr> 
                            <?php

                                $img_rs = Database::search("SELECT * FROM `profile_pics` WHERE `Customer_details_Email`='" . $customer_data['Email'] . "'");
                                $img_data = $img_rs->fetch_assoc();

                                ?>
                            

                            <th scope="row"><img src="<?php echo $img_data["Image_path"] ?>" class="cato-img" alt="customer profile image"></th>

                            <th><?php echo $customer_data["Email"]; ?></th>
                            <td><?php echo $customer_data["Name"]; ?></td>
                            <td><?php echo $customer_data["Registerd_Date"]; ?></td>
                            <td>
                                <div class="row m-1 ">

                                <button class="col btn btn-danger m-1" 
        onclick='removecustomer("<?php echo $customer_data["Email"]; ?>");' 
        id="<?php echo $customer_data["Email"]; ?>">
    <i class="bi bi-x-square-fill"></i>
</button>   </div>
                            </td>
                        </tr>
                    <?php
                    }

                    ?>


                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="script.js"></script>
</body>

</html>