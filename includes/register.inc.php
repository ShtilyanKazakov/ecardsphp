<?php
//include_once('../includes/error_display.inc.php');
include_once('../db.php');
$dbClient = new DatabaseClient();

$warning_errors = [];
$danger_errors = [];
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
    if (empty($username)) { array_push($warning_errors, "Username is required"); }
    if (empty($email)) { array_push($warning_errors, "Email is required"); }
    if (empty($password_1)) { array_push($warning_errors, "Password is required"); }

    if ($password_1 != $password_2) {
        array_push($warning_errors, "The two passwords do not match"); // danger error
        // Checking if the passwords match
    }

    // If the form is error free, then register the user
    if (count($warning_errors) == 0) {

        // Password encryption to increase data security
//        $password = md5($password_1);

        // Inserting data into table
//        $query = "INSERT INTO users (username, email, password)
//                  VALUES('$username', '$email', '$password')";
//
//        mysqli_query($db, $query);

        $insert_query = $dbClient->insert('users',
            [
                'username',
                'email',
                'password',
            ], [
                $_POST['username'],
                $_POST['email'],
                $_POST['password'],
            ]);
    } else {
        $_SESSION['status_warning'] = $warning_errors;
//        $_SESSION['status_danger'] = $danger_errors;
        // Page on which the user will be
        // redirected after logging in
    }
    header('location: register.php');
    exit;
}