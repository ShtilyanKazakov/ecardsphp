<?php
include('../includes/login.inc.php');
//$errors = array();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
<section class="vh-100 bg-image"
         style="background: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp')
         /*no-repeat center center fixed;*/
">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Login</h2>

                            <form method="POST" action="">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Username</label>
                                    <input type="text" name="username" id="form3Example3cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="login"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Do not have an account? <a href="register.php"
                                                                                                        class="fw-bold text-body"><u>Register here</u></a></p>
                                <p class="text-center text-muted mt-5 mb-0">Forgot your password? <a href="request_reset.php"
                                                                                                       class="fw-bold text-body"><u>Forgotten password</u></a></p>
<!--                                <a href="request_reset.php">Forgotten password</a>-->
                                <?php
                                if(count($_SESSION['status_warning']) > 0) {
                                    if(isset($_SESSION['status_warning'])) {
                                        foreach($_SESSION['status_warning'] as $error) {
                                            unset($_SESSION['status_warning']);
                                            echo '<p class="text-center alert alert-warning">'.$error.'</p>';
                                        }
                                    }
                                }
                                ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>