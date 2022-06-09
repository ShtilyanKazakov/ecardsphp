<?php
//session_start();

include_once('../db.php');
$dbClient = new DatabaseClient();


$code = $dbClient->real_escape_string($_POST['code']);
$description = $dbClient->real_escape_string($_POST['description']);
$image = $dbClient->real_escape_string($_POST['image']);

if (isset($_POST['submit'])) {
    if (!empty($image) || !empty($description)) {
        // extensions validations
        $image_picture_filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $image_path = "../views/cards/" . $image_picture_filename;
        // Get all the submitted data from the form

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $image_path)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }

        $dbClient->insert('cards',
            [
                'code',
                'description',
                'image',
            ], [
                $code,
                htmlspecialchars($description),
                $image_path,
            ]);
    } else {
        echo "<script>alert('Add Valid Data!');window.location.href='../public/index.php';</script>";
    }
    header("Location: ../public/create_card.php");
    exit();
}


?>