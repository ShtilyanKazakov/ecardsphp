<?php
//session_start();

include_once('../db.php');
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
            header("Location: C:\MAMP\htdocs\ecards\public\register.php");
            exit();
    }

}
//mysqli_close($conn);