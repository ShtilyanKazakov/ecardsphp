<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

include('../db.php');
$dbClient = new DatabaseClient(); // Using database connection file here

$card_id = $_GET['card_id']; // get id through query string

//$del = $dbClient->delete('cards', ['card_id'], [$_GET['card_id']]); // delete query
$del = $dbClient->mysqli_query_func("DELETE FROM cards WHERE card_id = '$card_id' ");
//$del2 = "DELETE FROM cards LEFT JOIN send_card ON cards.id = send_card.city_id WHERE cards.id = '$card_id'";

if ($del) {
    // Close connection
    header("Location: ../public/index.php"); // redirects to all records page
    exit();
} else {
    echo "Error deleting record"; // display error message if not delete
}

?>