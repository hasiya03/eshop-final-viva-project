<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Tech| Contact Us</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">




</head>

<body>
    <?php include "header.php"; ?>
    <h1 class="text-center">Contact Us</h1>
    <div class="row g-2">
    <div class="container  col-lg-6 ">
    <div class="  mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Inquiry:</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
</div>

<button type="submit" class="btn btn-primary">Send Inquiry</button>
    </div>

  <div class="  text-center  col-lg-6 mb-2">
    <h2>Contact Details</h2>
    <p>Email: info@example.com</p>
    <p>Phone: +1 (123) 456-7890</p>
    <p>Address: 123 Main Street, Cityville</p>
  </div>
    </div>








    <?php include "footer.php"; ?>
    <script src="script.js"></script>


</body>

</html>