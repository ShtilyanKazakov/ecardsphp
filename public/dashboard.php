<?php
session_start();
require_once('../db.php');
//include('../includes/login.php');
$errors = array();
//if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
    </head>
    <body>
        <h1>Hello, <?php echo $_SESSION['username'];  ?></h1>
        <a href="logout.php">Logout</a>
    </body>
    </html>

<?php
//}
?>