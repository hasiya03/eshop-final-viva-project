<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Tech||Admin Sales Page</title>
   
  <link rel="icon" href="pics/new tech custom logo.png" />
    
</head>
<body>
    <?php include "adminheader.php"; ?>
<div class="container mt-4">
<h2 class="text-center">Sales Summary</h2>
        
        <div class="row g-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text">$<span id="total-sales"></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Orders</h5>
                        <p class="card-text"><span id="total-orders"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart Section -->
    <div class="container mt-4">
        <h2 class="text-center">Sales Chart</h2>
        <div class="card">
            <div class="card-body">
                <canvas id="sales-chart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div id="error-message" style="color: red;"></div>
    


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
    <script src="sales.js"></script>
</body>
</html>
