<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session_start();
include_once('../db.php');
$dbClient = new DatabaseClient();

$errors = array();
//if (isset($_POST['register'])) {
//    // receive all input values from the form
//    // If data is to be INSERTED, use mysqli_real_escape_string
//    $username = $dbClient->real_escape_string($_POST['username']);
//    $email = $dbClient->real_escape_string($_POST['email']);
//    $password = $dbClient->real_escape_string($_POST['password']);
//    $retyped_password = $dbClient->real_escape_string($_POST['repeat_password']);
////    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//
//    // form validation: ensure that the form is correctly filled ...
//    if (empty($username)) {
//        array_push($errors, "Username is required");
//        print_r($errors);
//    }
//    if (empty($email)) {
//        array_push($errors, "Email is required");
//        print_r($errors);
//    }
//    if (empty($password)) {
//        array_push($errors, "Password is required");
//        print_r($errors);
//    }
//    if ($password !== $retyped_password) {
//        array_push($errors, "Passwords must match!");
//        print_r($errors);
//    }
//
//
////    $check_username = "SELECT * FROM users WHERE username='$username'";
//    $check_username = $dbClient->select('users', ['*'], 'username=$username');
////    $check_email = "SELECT * FROM users WHERE email='$email'";
//    $check_email = $dbClient->select('users', ['*'], 'email=$email');
////    $query_username = mysqli_query($conn, $check_username);
////    $query_email = mysqli_query($conn, $check_email);
//
//    if ($check_username > 0 && $check_email > 0) {
//        $error = true;
//        echo '<script language="javascript">';
//        echo 'alert("Username And Email already taken")';
//        echo '</script>';
//    }
//
//    elseif ($check_username > 0) {
//        $error = true;
//        echo '<script language="javascript">';
//
//        echo 'alert("Username already taken")';
//        echo '</script>';
//    }
//
//    else if($check_email > 0) {
//        $error = true;
//        echo '<script language="javascript">';
//
//        echo 'alert("Email already taken")';
//        echo '</script>';
//        header("Refresh:0; url=register.php");
//    }
//
//    else {
////        $query = "INSERT INTO users (username, email, password)
////      	    	  VALUES ('$username', '$email', '" . md5($password) . "')";
////        $results = mysqli_query($conn, $query);
//        $dbClient->insert('users',
//            [
//                'username',
//                'email',
//                'password',
//            ], [
//                $username,
//                $email,
//                md5($password),
//            ]);
//        header("Location: login.php");
//        exit();
//    }
//
//}

if (isset($_POST['register'])) {

    // Receiving the values entered and storing
    // in the variables
    // Data sanitization is done to prevent
    // SQL injections
    $username = $dbClient->real_escape_string($_POST['username']);
    $email = $dbClient->real_escape_string($_POST['email']);
    $password_1 = $dbClient->real_escape_string($_POST['password']);
    $password_2 = $dbClient->real_escape_string($_POST['repeat_password']);

    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }

    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
        // Checking if the passwords match
    }

    // If the form is error free, then register the user
    if (count($errors) == 0) {

        // Password encryption to increase data security
//        $password = md5($password_1);

        // Inserting data into table
//        $query = "INSERT INTO users (username, email, password)
//                  VALUES('$username', '$email', '$password')";
//
//        mysqli_query($db, $query);

        $dbClient->insert('users',
            [
                'username',
                'email',
                'password',
            ], [
                $_POST['username'],
                $_POST['email'],
                $_POST['password'],
            ]);


//        // Storing username of the logged in user,
//        // in the session variable
//        $_SESSION['username'] = $username;
//
//        // Welcome message
//        $_SESSION['success'] = "You have logged in";

        // Page on which the user will be
        // redirected after logging in
        header('location: register.php');
    }
}