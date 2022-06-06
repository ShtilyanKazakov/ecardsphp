<?php
session_start();
//include_once('../includes/error_display.inc.php');

include('../db.php');
$dbClient = new DatabaseClient();
$warning_errors = array();

if (isset($_POST['login'])) {
    $username = $dbClient->real_escape_string($_POST['username']);
    $password = $dbClient->real_escape_string($_POST['password']);

    if (empty($username)) {
        $warning_errors[] = "Username is required";
    }
    if (empty($password)) {
        $warning_errors[] = "Password is required";
    }

    $query = "SELECT * FROM users WHERE username='$username' AND email_verified_at IS NOT NULL";
    $results = $dbClient->mysqli_query_func($query);
    $user = mysqli_fetch_assoc($results);


    if ($user['username'] !== $username) {
        $warning_errors[] = "Wrong Username credentials!!!";
    }
    if (!password_verify($password, $user['password'])) {
        $warning_errors[] = "Password is invalid!";
    }

    if(empty($user['email_verified_at'])) {
        $warning_errors[] = "Account not verified!!";
    }

    if (count($warning_errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username'";
        $results = $dbClient->mysqli_query_func($query);

        if (mysqli_num_rows($results) == 1) {
            while ($row = mysqli_fetch_assoc($results)) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: dashboard.php");
                    exit;
                }
                else{
                    $warning_errors[] = "Username or Password is invalid!";
                }
            }
        }
    }else {
        $_SESSION['status_warning'] = $warning_errors;
        header('location: login.php');
        exit;
    }
}