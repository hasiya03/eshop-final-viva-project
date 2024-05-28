<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Sign in 
    </title>
</head>

<body>
    <div class="container">
        <div class="container text-center"><a class="" href="index.php"><img src="pics/new tech custom logo.png" alt="logo" width="100px" height="100px"></a></div>
        <div class="signincard   border border-secondary m-2" id="card">
            <div class="card-face card-front">
                <div class="card-body">
                    <div class="container text-center mb-2">
                        <h1>SIGN UP</h1>
                    </div>
                    <div class="col-12 d-none" id="msgdiv">
                        <div class="alert alert-danger" role="alert" id="msg">

                        </div>
                    </div>
                    <form class="row g-3">
                        
                        <div class="col-md-12">
                            <label for="lname" class="form-label">Name</label>
                            <input type="text" class="form-control border border-dark-subtle" placeholder="ex:Lincolin summers" id="name" />
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control border border-dark-subtle" placeholder="ex:Jhon@gmail.com" id="email" />
                        </div>
                        <div class="col-md-12">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control border border-dark-subtle" placeholder="ex:0909090909" id="mobile" />
                        </div>
                        <div class="col-md-12">
                            <label for="gender" class="form-label">Gender</label>
                            <select type="text" class="form-control border border-dark-subtle" id="gender">
                                <option value="0">Select your Gender</option>
                                <?php
                                require "connection.php";

                                $rs = Database::search("SELECT * FROM `gender`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $d["Gender id"]; ?>"><?php echo $d["Name"]; ?></option>

                                <?php

                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">

                            <label for="inputPassword4" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control border border-dark-subtle" placeholder="***********" id="password" />
                                <button type="button" class="btn btn-outline-secondary  "><i class="bi bi-eye"></i></button>
                            </div>
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
                            <p class="p-1 m-2">Already have an account?<a class=" link-offset-2 link-underline link-underline-opacity-0" onclick="flipCard()" href="#"> Sign In </a></p>
                        </div>
                        <div class="d-grid col-12 mx-auto">
                            <button type="submit" class="btn btn-primary" onclick="signUp();">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-face card-back">
                <div class="container"><img src="pics/products/Lotus Flower Theme KeyCap Set, OEM Profile PBT Subdye Keycap, Ink Painting Theme Gaming Mechanical Keyboard Keycap, Black Artisan Keycaps.jpg" class=" w-100"></div>
                <div class=" card-body mb-3 ">


                    <div class="container text-center mb-2">
                        <h1>SIGN IN</h1>
                    </div>

                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control border border-dark-subtle" id="loginemail">
                        </div>
                        <div class="col-md-12">

                            <label for="inputPassword4" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control border border-dark-subtle" id="loginepass">
                                <button type="button" class="btn btn-outline-secondary  "><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border border-primary-subtle" type="checkbox" id="rememberme">
                            <label class="form-check-label " for="gridCheck">
                                Remember Me.
                            </label>

                        </div>
                        <p class="">Have you forgotten your password ? <a class=" link-offset-2 link-underline link-underline-opacity-0" href="#" onclick="forgotpassword();"> Click Here</a></p>
                        <button type="submit" class="btn btn-danger" onclick="flipCard()">Still doesn't have an account?</button>
                        <button type="submit" class="btn btn-primary" onclick="signin();">Sign in</button>
                    </form>
                </div>

            </div>
        </div>

         <!-- modal -->
         <div class="modal" tabindex="-1" id="forgotPasswordModal">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Forgot Password?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div class="row g-3">

                                  <div class="col-6">
                                      <label class="form-label">New Password</label>
                                      <div class="input-group mb-3">
                                          <input type="password" class="form-control" id="np" />
                                          <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();">
                                              <i class="bi bi-eye"></i>
                                          </button>
                                      </div>
                                  </div>

                                  <div class="col-6">
                                      <label class="form-label">Retype New Password</label>
                                      <div class="input-group mb-3">
                                          <input type="password" class="form-control" id="rnp" />
                                          <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">
                                              <i class="bi bi-eye"></i>
                                          </button>
                                      </div>
                                  </div>

                                  <div class="col-12">
                                      <label class="form-label">Verification Code</label>
                                      <input type="text" class="form-control" id="vcode" />
                                  </div>

                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" onclick="ResetPassword();">Reset Password</button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- modal -->

    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   
    <script src="script.js"></script>
</body>

</html>