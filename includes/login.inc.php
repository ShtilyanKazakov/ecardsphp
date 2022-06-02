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

    //        $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = $dbClient->mysqli_query_func($query);
    $user = mysqli_fetch_assoc($results);

    if ($user['username'] !== $username || $user['password'] !== $password) {
        $warning_errors[] = "Wrong Username/Password credentials!!!"; // array_push($warning_errors, "Wrong Username credentials!!!");
    }

    if (count($warning_errors) == 0) {
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['success'] = "You are now logged in";
            header('Location: dashboard.php');
            exit;
        }
    } else {
        $_SESSION['status_warning'] = $warning_errors;
    }
    header('location: login.php');
    exit;
}