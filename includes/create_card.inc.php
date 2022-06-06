<?php
session_start();

include_once('../db.php');
$dbClient = new DatabaseClient();

function upload_image()
{

    define('MAX_FILE_SIZE', 1000000);
    $permitted = array('image/gif', 'image/jpeg', 'image/png', 'image/pjpeg', 'text/plain');
    $abs_upload_path = __DIR__ . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "cards" . DIRECTORY_SEPARATOR;
    $filetype = "";

    if ($_FILES['the_file']['size'] > 0 && $_FILES['the_file']['size'] <= MAX_FILE_SIZE) {
        if ($_FILES['the_file']['error'] == 0) {
            move_uploaded_file($_FILES["the_file"]["tmp_name"], $abs_upload_path . $_FILES["the_file"]["name"]);

            if (in_array($_FILES['the_file']['type'], $permitted)) {

                echo '<img src="../views/cards/' . $_FILES["the_file"]["name"] . '">';
            } elseif ($filetype == "text") {
                echo nl2br(file_get_contents("../views/cards/" . $_FILES["the_file"]["name"]));
            }

        } else {
            echo "Not permitted filetype.";
        }
    }
}

// check if user is logged in if not redirect to login.php

$description = $_POST['description'];
$card_image = $_POST['image'];

if (!isset($_SESSION['user_id'])) {
header("Location: login.php");
die();
}

// check if a tweet has been submitted if not just show the form

if (isset($_POST["description"]) && !empty($_POST["description"])) {
$sql = "INSERT INTO cards (id, image, description) VALUES ('{$_SESSION['user_id']}', '{$_FILES['the_file']['name']}', '$description')";
    $dbClient->mysqli_query_func($sql);
    upload_image();
}
//if (mysqli_query($conn, $sql) == true) {
//header("Location: ../public/dashboard.php");
//die();
//}


// if a tweet has been submitted the save it in the database an then show the form


?>