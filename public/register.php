<?php
session_start();
//$errors = array();
include('../includes/register.inc.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
<section class="vh-100 bg-image"
         style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            <form method="POST" action="">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1cg">Username</label>
                                    <input type="text" name="username" id="form3Example1cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Email</label>
                                    <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                    <input type="password" name="repeat_password" id="form3Example4cdg" class="form-control form-control-lg" />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="register"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php"
                                                                                                        class="fw-bold text-body"><u>Login here</u></a></p>
<!--                                <div class="form-outline mb-4">-->
                                    <?php
//                                    if(isset($_SESSION['status_warning'])) {
//                                        $message = $_SESSION['status_warning'];
//                                        unset($_SESSION['status_warning']);
//                                        echo $message;
//                                    }
//                                    if(isset($_SESSION['status_danger'])) {
//                                        $message = $_SESSION['status_danger'];
//                                        unset($_SESSION['status_danger']);
//                                        echo $message;
//                                    }

//                                    if(count($_SESSION['status_danger']) > 0) {
//                                        if(isset($_SESSION['status_danger'])) {
//                                            foreach($_SESSION['status_danger'] as $danger_error) {
//                                                unset($_SESSION['status_danger']);
//                                                echo '<p class="text-center alert alert-danger">'.$danger_error.'</p>';
//                                            }
//                                        }
//                                    }

                                    if(count($_SESSION['status_warning']) > 0) {
                                        if(isset($_SESSION['status_warning'])) {
                                            foreach($_SESSION['status_warning'] as $warning_error) {
                                                unset($_SESSION['status_warning']);
                                                echo '<p class="text-center alert alert-warning">'.$warning_error.'</p>';
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