<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["Email"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$query = "SELECT * FROM `product_details` WHERE `Customer_details_Email`='" . $email . "' ";

if (!empty($search)) {
    $query .= " AND `Name` LIKE '%" . $search . "%'";
}

if ($condition != "0") {
    $query .= " AND `Condition_Condition_id`='" . $condition . "'";
}

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `Listing_date` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `Listing_date` ASC";
    }
}

if ($qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `QTY` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `QTY` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `QTY` DESC";
    } else if ($qty == "2") {
        $query .= " , `QTY` ASC";
    }
}

?>



<div  id="sort">




    <div class="table-responsive rounded-top ">

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

                if ("0" !=($_POST["page"])) {
                    $pageno = $_POST["page"];
                } else {
                    $pageno = 1;
                }

                $product_rs = Database::search($query);
                $product_num = $product_rs->num_rows;

                $results_per_page = 2;
                $number_of_pages = ceil($product_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

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

                                <button class="col btn btn-danger m-1 "><i class="bi bi-x-square-fill"></i></button>
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
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="sort(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                }
                                                                                                    ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="sort(<?php echo ($y); ?>)"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="sort(<?php echo ($y); ?>)"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="sort(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>
