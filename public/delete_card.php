<?php

include('../db.php');
$dbClient = new DatabaseClient(); // Using database connection file here

$card_id = $_GET['card_id']; // get id through query string

$del = $dbClient->mysqli_query_func("UPDATE cards SET flag_delete = 1 WHERE card_id='$card_id' ");

if ($del) {
    // Close connection
    header("Location: ../public/index.php"); // redirects to all records page
    exit();
} else {
    echo "Error deleting record"; // display error message if not delete
}

?>