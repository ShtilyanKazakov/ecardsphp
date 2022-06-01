<?php
//session_start();
////ini_set('display_errors', 1);
////ini_set('display_startup_errors', 1);
////error_reporting(E_ALL);
//
//include('../db.php');
//$dbClient = new DatabaseClient();
////
//$errors = array();
////
//if (isset($_POST['login'])) {
//
//    $username = $_POST['username'];
////    $email = $_POST['email'];
//    $password = $_POST['password'];
////    $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
//
////    if(isset($_POST['username']) && isset($_POST['password'])) {
//    if (empty($username)) {
//        array_push($errors, "Username is required");
//    }
//    if (empty($password)) {
//        array_push($errors, "Password is required");
//    }
//
////        $user_login = $dbClient->select('users', ['id', 'username', 'email', 'password'], "'username=$username' AND 'password=$password'");
//////        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
//////        $results = mysqli_query($conn, $query);
////        $user = mysqli_fetch_assoc($user_login);
////
////        if (mysqli_num_rows($user_login) == 1) {
////            $_SESSION['username'] = $username;
////            $_SESSION['id'] = $user['id'];
////            $_SESSION['success'] = "You are now logged in";
////            header('Location: dashboard.php');
////        } else {
////            array_push($errors, "Wrong username/password combination");
////        }
//
//    if (count($errors) == 0) {
//
//        // Password matching
//        $password = md5($password);
//
//        $where_cond = [
//            "username" => $username,
//            "password" => $password
//        ];
//
//        $query = $dbClient->select('users', ['*'], $where_cond);
////        $results = mysqli_query($db, $query);
//
//        // $results = 1 means that one user with the
//        // entered username exists
//        if (mysqli_num_rows($query) == 1) {
//
//            // Storing username in session variable
//            $_SESSION['username'] = $username;
//
//            // Welcome message
//            $_SESSION['success'] = "You have logged in!";
//
//            // Page on which the user is sent
//            // to after logging in
//            header('location: dashboard.php');
//        } else {
//
//            // If the username and password doesn't match
//            array_push($errors, "Username or password incorrect");
//        }
//    }
//}


//$errors = array();
//include('../includes/login.inc.php');


session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include('../db.php');
$dbClient = new DatabaseClient();
//
$errors = array();
//

if (isset($_POST['login'])) {
    $username = $dbClient->real_escape_string($_POST['username']);
    $password = $dbClient->real_escape_string($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
//        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = $dbClient->mysqli_query_func($query);
        $user = mysqli_fetch_assoc($results);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['success'] = "You are now logged in";
            header('Location: dashboard.php');
//            die();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
