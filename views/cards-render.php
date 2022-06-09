<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('../db.php');
//include_once('../includes/edit_card.inc.php');
$dbClient = new DatabaseClient();
//$id = $_GET['card_id'];
//$select_card = $dbClient->select('cards', ['card_id', 'description', 'image']);

$select_card = $dbClient->mysqli_query_func("SELECT * FROM cards");
//$select_card = $dbClient->select( "cards", ['card_id', 'description', 'image']);
//$select_card = $dbClient->select('cards', ['card_id', 'users_id', 'code', 'description', 'image']);


//var_dump($select_card);
//if (mysqli_num_rows($select_card) > 0) {
while ($row = mysqli_fetch_assoc($select_card)) {
    $image_src = $row['image'];
    ?>
    <div class="card" style="width: 18rem;">
        <?php if ($row['flag_delete'] == 0) { ?>
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) { ?>
                <a href="../public/card_view.php?card_id=<?= $row['card_id']; ?>">
                    <img class="card-img-top" width="200px" height="200px" src="<?= $image_src; ?>"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['card_id']; ?></h5>
                        <p class="card-text"><?= $row['description']; ?></p>
                        <!--            <a href="#" class="btn btn-primary">Go somewhere</a>-->
                        <!--            ${accessButton}-->
                    </div>
                </a>
            <?php } else {
                ?>
                <img class="card-img-top" width="200px" height="200px" src="<?= $image_src; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['card_id']; ?></h5>
                    <p class="card-text"><?= $row['description']; ?></p>
                    <!--            <a href="#" class="btn btn-primary">Go somewhere</a>-->
                    <!--            ${accessButton}-->
                </div>
                <?php
            } ?>


            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) { ?>
                <a class="btn btn-primary" role="button"
                   href="../public/edit_card.php?card_id=<?php echo $row['card_id']; ?>">Edit</a>
                <a class="btn btn-danger" role="button"
                   href="../public/delete_card.php?card_id=<?php echo $row['card_id']; ?>">Delete</a>
            <?php } else {
                echo '';
            } ?>
        <?php } ?>
    </div>
    <?php
}
//}
?>