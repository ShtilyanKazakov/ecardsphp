<?php
session_start();
require_once("../utilities/header.php");
?>

<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include('../db.php');

$dbClient = new DatabaseClient();
?>


<?php
$code = $dbClient->real_escape_string($_GET['code']); // sql injection
$query_send_card = $dbClient->mysqli_query_func( "SELECT cards.description, cards.card_id, cards.image, sc.description_card, sc.recipient_email FROM send_card AS sc JOIN cards ON cards.card_id = sc.card_id WHERE sc.code = '$code'");
//$query_send_card = $dbClient->mysqli_query_func( "SELECT * FROM cards WHERE card_id = '$card_id'");
//$email_to = $_POST['email'];

if (mysqli_num_rows($query_send_card) > 0) {
    while ($row = mysqli_fetch_array($query_send_card)) {
        ?>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="200px" height="200px" src="<?= $row['image']; ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $row['card_id']; ?></h5>
                <h1 class="card-title">This is the personal card view page</h1>
                <p class="card-text"><?= $row['description']; ?></p>
                <p class="card-text"><?= $row['description_card']; ?></p>
                <p class="card-text">Recipient is:<?= $row['recipient_email']; ?></p>
            </div>
        </div>
        <?php
    }

    // PHP Mailer Settings

}
?>

<?php require_once("../utilities/footer.php"); ?>