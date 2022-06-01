<?php

include('../db.php');
$dbClient = new DatabaseClient();

$errors = array();


if (isset($_POST['login'])) {
    $email = $dbClient->real_escape_string($_POST['email']);
    $password = $dbClient->real_escape_string($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($results);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['success'] = "You are now logged in";
            header('Location: dashboard.php');
            die();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}