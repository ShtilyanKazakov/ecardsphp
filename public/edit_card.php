<?php
include('../includes/edit_card.inc.php');

include_once('../db.php');
//include_once('../public/edit_card.php');

$dbClient = new DatabaseClient();

//if (isset($_GET['update'])) {
//    $id = $_GET['did'];
//    $card_id = $_GET['card_id'];
//    $description = $_POST['description'];
//    $query = $dbClient->mysqli_query_func("UPDATE cards SET description='$description' WHERE card_id='$card_id'");
//}
//$query = $dbClient->mysqli_query_func("select * from cards");
//while ($row = mysqli_fetch_array($query)) {
//    echo "<b><a href='updatephp.php?update={$row['employee_id']}'>{$row['employee_name']}</a></b>";
//    echo "<br />";
//}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Card</title>
</head>
<body>
<?php


//    $selection_all_clients = $dbClient->select('cards', ['*'], "card_id='$card_id'");
//$selection_all_cards = $dbClient->mysqli_query_func("SELECT * FROM cards WHERE card_id='$card_id'");
//if (mysqli_num_rows($selection_all_cards) > 0) {
//    while ($row = mysqli_fetch_array($selection_all_cards)) {
//        ?>


<?php
//if (isset($_POST['update'])) {
//
//$card_id = $_POST['card_id'];
//$description = $_POST['description'];
//$dbClient->mysqli_query_func("UPDATE cards SET description='$description'");
//}

?>
<br><h3 class="text-center">Edit data:</h3><br>
<form class="col-6 container" name="form" method="POST" enctype="multipart/form-data"><br>
    <div class="row">
        <?php
        $id = $_GET['card_id'];
//        $selection_all_clients = $dbClient->select('cards', ['*'], "card_id='$id'");
        $selection_all_clients = $dbClient->mysqli_query_func("SELECT * FROM cards WHERE card_id='$id'");
        if (mysqli_num_rows($selection_all_clients) > 0) {
        while ($rowing = mysqli_fetch_array($selection_all_clients)) {
        ?>
        <div class="form-group col-12">
            <label for="description" class="form-label">Edit Description:</label>
            <textarea name="description" class="form-control" rows="10" cols="70"><?php echo $rowing['description'] ?></textarea>
        </div>

        <div class="form-group col-12">
            <label for="profile_picture" class="form-label">Edit Profile Picture:</label>
            <input type="file" class="form-control" id="profile_picture" name="image"/>
<!--                   value="--><?//=$_FILES["image"]["name"]; ?><!--"-->
            <img src="<?=$rowing['image']; ?>" width="150px" height="100px" />
        </div>
        <input type="submit" name="update" value="update">

<!--        <div class="col-12 text-center">-->
<!--            <button type="submit" name="update" value="Update" class="btn btn-primary">Edit</button>-->
<!--        </div>-->
    </div>
</form>

<?php
}
}
?>
<?php
//}
//}
//?>
</body>
</html>
