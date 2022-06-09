<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include_once('../db.php');
//include_once('../public/edit_card.php');

$dbClient = new DatabaseClient();


if (isset($_POST['update'])) {
    $card_id = $_GET['card_id'];
    $profile_picture_filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $image_path = "../views/cards/" . $profile_picture_filename;
    var_dump($image_path);
    $description = $_POST['description'];

    if (move_uploaded_file($tempname, $image_path)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
//    }

//            $name = $_POST['name'];
//            $code_type = $_POST['code_type'];

    $update_data = array(
        'description' => $_POST['description'],
        'image' => $image_path,
    );

    $where_condition = array(
        'card_id' => $_GET['card_id']
    );

    if(empty($_FILES["image"]["name"])) { // if image input if empty, use old one(make no changes)
        unset($update_data['image']);
        $dbClient->update("cards", $update_data, $where_condition);
//        $dbClient->mysqli_query_func("UPDATE cards SET description='$description', image='$image_path' WHERE card_id='$card_id'");
    } else { // else make changes
        $dbClient->update("cards", $update_data, $where_condition);
//        $dbClient->mysqli_query_func("UPDATE cards SET description='$description', image='$image_path' WHERE card_id='$card_id'");
    }

    // Close connection
    header("Location: ../public/index.php"); // redirects to all records page
    exit;

}
