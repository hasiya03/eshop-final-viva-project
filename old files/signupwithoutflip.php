<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        New Tech||SignIn/Signup
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>


    <div class="container">
        <div class="container text-center"><a class="" href="homepage.php"><img src="pics/new tech custom logo.png" alt="logo" width="100px" height="100px"></a></div>
        <div class="card  mx-auto border border-secondary m-2" >
            <div class="card-body ">
                <div class="container text-center mb-2">
                    <h1>SIGN UP</h1>
                </div>
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="fname" class="form-label ">First name</label>
                        <input type="email" class="form-control border border-dark-subtle" id="fname">
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="form-label">Last name</label>
                        <input type="password" class="form-control border border-dark-subtle" id="lname">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control border border-dark-subtle" id="inputEmail4">
                    </div>
                    <div class="col-md-6">
                    
                        <label for="inputPassword4" class="form-label">Password</label>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control border border-dark-subtle" id="inputPassword4">
                       <button type="button" class="btn btn-outline-secondary  "><i class="bi bi-eye"></i></button>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <label for="passwordretype" class="form-label">Re-type password</label>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control border border-dark-subtle" id="passwordretype">
                        <button type="button" class="btn btn-outline-secondary  "><i class="bi bi-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control border border-dark-subtle" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Address 2</label>
                        <input type="text" class="form-control border border-dark-subtle" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label ">City</label>
                        <input type="text" class="form-control border border-dark-subtle" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label ">State</label>
                        <select id="inputState" class="form-select border border-dark-subtle">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label ">Zip</label>
                        <input type="text" class="form-control border border-dark-subtle" id="inputZip">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input border border-primary-subtle" type="checkbox" id="gridCheck">
                            <label class="form-check-label " for="gridCheck">
                               By checking this you agree to New Tech's Conditions of Use and Privacy Notice.
                            </label>
                            
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border border-primary-subtle" type="checkbox" id="gridCheck">
                            <label class="form-check-label " for="gridCheck">
                               Subscribe to our newsletter,to recieve daily deals and updates.
                            </label>
                            
                        </div>
                        <p class="p-1 m-2">Already have an account?<a class="link-offset-2 link-underline link-underline-opacity-0" href="signin.php"> Sign In </a></p>
                    </div>
                    <div class="d-grid col-12 mx-auto">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <?php include "footer.php"; ?>
    <script src="script.js"></script>
</body>

</html>