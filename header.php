<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>

    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body>

    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="row overflow-x-hidden">
            <div class="col-12 col-lg-6">
                <ul class="header-links ">

                    <?php
                    session_start();
                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                    ?>
                        <span class="text-lg-start text-danger fst-italic mx-1"><b>Hi </b> <?php echo $data["Name"]; ?></span>
                        <span class="text-white mx-2">|| </span>
                        <span class="text-lg-end text-danger" onclick="signout();"> Sign Out</span>

                    <?php

                    } else {
                    ?>
                        <li><a href="signup.php" class="link-underline link-underline-opacity-0"> Sign In or Sign Up</a></li>

                    <?php

                    }
                    ?>
                </ul>
            </div>
            <div class="col-12 col-lg-6   text-lg-end">

                <ul class="header-links ">

                    <?php
                    if (isset($_SESSION["u"])) {
                        if (($_SESSION["u"]["Email"]) && $_SESSION["u"]["Email"] === "admin@gmail.com") {

                    ?>
                           
                            <li><a href="sales.php">Admin LogIn</a></li>
                        <?php


                        } else {
                        ?>
                            <li><a href="profile.php"><i class="fa fa-user-o"></i> My Account</a></li>
                            <li><a href="#" class=" d-none">Admin LogIn</a></li>
                        <?php

                        }
                    } else {
                        ?>
                        <li><a href="signup.php" class="d-none"> My Account</a></li>
                        <li><a href="#" class="d-none">Admin LogIn</a></li>

                    <?php

                    }
                    ?>







                </ul>
            </div>


        </div>
    </div>
    <!-- /TOP HEADER -->


    <div class=" ">
        <nav class="navbar navbar-expand-lg bg-body-secondary ">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="pics/new tech custom logo.png" alt="logo" width="100px" height="100px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="container collapse navbar-collapse offset-lg-3  " id="navbarSupportedContent">
                    <form class="input-group">
                        <input class="form-control  border border-black  " type="text" placeholder="Search" id="search_text">
                    </form>
                    <button class="btn btn-outline-success m-1" onclick="basicSearch(0);"><i class="bi bi-search h1" style="font-size: 20px;"></i></button>

                </div>
                <div class="collapse navbar-collapse offset-lg-4" id="navbarSupportedContent">
                    <a  href="cart.php"class="btn btn-secondary  m-1 fs-4"><i class="bi bi-cart2"></i></a>
                    <button class="btn btn-secondary fs-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvasExample"><i class="bi bi-bag-heart"></i></i></button>

                </div>
            </div>
        </nav>

    </div>






    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>