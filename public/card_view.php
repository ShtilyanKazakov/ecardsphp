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
$card_id = $_GET['card_id'];
//$query_select_from_card = $dbClient->select('cards', ['*'], "card_id='$card_id'");
//$query_select_from_card = $dbClient->mysqli_query_func( "SELECT cards.description, cards.card_id, cards.image FROM send_card AS sc JOIN cards ON cards.card_id = sc.card_id WHERE sc.code = '$code'");
$query_select_from_card = $dbClient->mysqli_query_func( "SELECT * FROM cards WHERE card_id = '$card_id'");

if (mysqli_num_rows($query_select_from_card) > 0) {
    while ($row = mysqli_fetch_array($query_select_from_card)) {
        ?>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="200px" height="200px" src="<?= $row['image']; ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $row['card_id']; ?></h5>
                <h1 class="card-title">This is the personal card view page</h1>
                <p class="card-text"><?= $row['description']; ?></p>
                <form method="post" action="../includes/send-card.inc.php">
                    <input type="hidden" name="card_id" value="<?=$card_id ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" name="email" autocomplete="off" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter email">
                        <input type="text" name="description_card" autocomplete="off" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter Description">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Send card">
                    </div>
                </form>
                <!--            <a href="#" class="btn btn-primary">Go somewhere</a>-->
                <!--            ${accessButton}-->
            </div>
        </div>
        <?php
    }

    // PHP Mailer Settings

}
?>

<?php require_once("../utilities/footer.php"); ?>