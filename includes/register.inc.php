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
    $password = $dbClient->real_escape_string($_POST['password']);
    $repeat_password = $dbClient->real_escape_string($_POST['repeat_password']);

    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($username)) { array_push($warning_errors, "Username is required"); }
    if (empty($email)) { array_push($warning_errors, "Email is required"); }
    if (empty($password)) { array_push($warning_errors, "Password is required"); }

    if ($password != $repeat_password) {
        array_push($warning_errors, "Passwords do not match"); // danger error
        // Checking if the passwords match
    }

    $check_duplicates = $dbClient->select('users', ['*'], "username='$username' OR email='$email'");
//    $check_duplicates = $dbClient->mysqli_query_func("SELECT * FROM users WHERE username='$username' OR email='$email'")
    if (mysqli_num_rows($check_duplicates)>0) {
        header("Location: ../public/index.php?message=User name or Email id already exists.");
        array_push($warning_errors, "Username or Email alreay exists");
    }

    // If the form is error free, then register the user
    if (count($warning_errors) == 0) {
        $option = [
            'cost' => 12
        ];
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $option);
        $insert_query = $dbClient->insert('users',
            [
                'username',
                'email',
                'password',
            ], [
                $username,
                $email,
                $password_hashed,
            ]);
            array_push($warning_errors, "User Created Successfuly");
    }
    $_SESSION['status_warning'] = $warning_errors;
    header('location: register.php');
    exit;
}