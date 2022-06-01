<?php

$dbClient = new DatabaseClient();

$errors = array();
if (isset($_POST['register'])) {
    // receive all input values from the form
    // If data is to be INSERTED, use mysqli_real_escape_string
    $username = $dbClient->real_escape_string($_POST['username']);
    $email = $dbClient->real_escape_string($_POST['email']);
    $password = $dbClient->real_escape_string($_POST['password']);
    $retyped_password = $dbClient->real_escape_string($_POST['repeat_password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // form validation: ensure that the form is correctly filled ...
    if (empty($username)) {
        array_push($errors, "Username is required");
        print_r($errors);
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
        print_r($errors);
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
        print_r($errors);
    }
    if ($password !== $retyped_password) {
        array_push($errors, "Passwords must match!");
        print_r($errors);
    }


//    $check_username = "SELECT * FROM users WHERE username='$username'";
    $check_username = $dbClient->select('users', ['*'], 'username=$username');
//    $check_email = "SELECT * FROM users WHERE email='$email'";
    $check_email = $dbClient->select('users', ['*'], 'email=$email');
//    $query_username = mysqli_query($conn, $check_username);
//    $query_email = mysqli_query($conn, $check_email);

    if ($check_username > 0 && $check_email > 0) {
        $error = true;
        echo '<script language="javascript">';
        echo 'alert("Username And Email already taken")';
        echo '</script>';
    }

    elseif ($check_username > 0) {
        $error = true;
        echo '<script language="javascript">';

        echo 'alert("Username already taken")';
        echo '</script>';
    }

    else if($check_email > 0) {
        $error = true;
        echo '<script language="javascript">';

        echo 'alert("Email already taken")';
        echo '</script>';
        header("Refresh:0; url=register.php");
    }

    else {
//        $query = "INSERT INTO users (username, email, password)
//      	    	  VALUES ('$username', '$email', '" . md5($password) . "')";
//        $results = mysqli_query($conn, $query);
        $dbClient->insert('users',
            [
                'name',
                'email',
                'password',
            ], [
                $username,
                $email,
                $hashed_password,
            ]);
        header("Location: ../register.php?signup=success");
        exit();
    }

}

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

                            <form method="POST" action="register.php">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1cg">Username</label>
                                    <input type="text" name="name" id="form3Example1cg" class="form-control form-control-lg" />
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
                                    <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                                                                                                        class="fw-bold text-body"><u>Register here</u></a></p>
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