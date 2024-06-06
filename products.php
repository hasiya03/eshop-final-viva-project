<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["Email"];

    $pageno;

?>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            New Tech||Product List
        </title>
        
  <link rel="icon" href="pics/new tech custom logo.png" />
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    </head>

    <body>
        <?php include "adminheader.php"; ?>
        <h2 class="text-center">Product List</h2>
        <div class="col-12">
            <div class="row">
                <!-- filter -->
               
                
    

                <div  class="container">




                    <div class="table-responsive rounded-top container">

                        <table class="table table-hover table-dark table-striped mt-2 p-2">

                            <thead>
                                <tr>
                                    <th scope="col"> Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
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

                                $product_rs = Database::search("SELECT * FROM `product_details` WHERE `Customer_details_Email`='" . $email . "'");
                                $product_num = $product_rs->num_rows;

                                $results_per_page = 5;
                                $number_of_pages = ceil($product_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page;
                                $selected_rs = Database::search("SELECT * FROM `product_details` WHERE `Customer_details_Email`='" . $email . "'
LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                $selected_num = $selected_rs->num_rows;
                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();

                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $selected_data["Product_ID"]; ?></th>
                                        <td><?php echo $selected_data["Name"]; ?></td>
                                        <td><?php echo $selected_data["QTY"]; ?></td>
                                        <td><?php echo $selected_data["price"]; ?></td>

                                        <td>
                                            <div class="row m-1 ">
                                                <button class="col btn btn-primary m-1" onclick="sendId(<?php echo $selected_data['Product_ID']; ?>);">Edit</button>

                                                <button class="col btn btn-danger m-1 " onclick='removeproduct("<?php echo $selected_data["Product_ID"]; ?>");' 
        id="<?php echo $selected_data['Product_ID']; ?>"> <i class="bi bi-x-square-fill"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>

                            </tbody>
                        </table>

                    </div>
                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>

                                            <?php

                                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                                if ($y == $pageno) {
                                            ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                            <?php
                                                }
                                            }

                                            ?>

                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                </div>
                
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="script.js"></script>
    </body>

    </html>


<?php

}

?>