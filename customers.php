<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        New Tech||Customer Details
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include "adminheader.php"; ?>
    <h2 class="text-center">Customers</h2>
    <div class="table-responsive">

    <table class="table table-hover table-secondary table-striped mt-2 p-2">

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>
                    <div class="row m-1 ">
                    <button class="col btn btn-primary m-1">View</button>
                    <button class="col btn btn-danger m-1 "><i class="bi bi-x-square-fill"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>
                    <div class="row m-1 ">
                    <button class="col btn btn-primary m-1">View</button>
                    <button class="col btn btn-danger m-1 "><i class="bi bi-x-square-fill"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                <td>
                    <div class="row m-1 ">
                    <button class="col btn btn-primary m-1">View</button>
                    <button class="col btn btn-danger m-1 "><i class="bi bi-x-square-fill"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    </div>



    <script src="script.js"></script>
</body>

</html>