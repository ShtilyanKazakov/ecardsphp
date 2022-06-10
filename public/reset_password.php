<?php
include('../db.php');
include('../utilities/header.php');
$dbClient = new DatabaseClient();

if(!isset($_GET["code"])) {
    exit("Cannot find page!");
}

$code = $_GET["code"];
$get_email_query = $dbClient->mysqli_query_func("SELECT email FROM reset_password_codes WHERE code='$code'");

if(isset($_POST["password"])) {

    $password = $_POST["password"];
    $option = [
        'cost' => 12
    ];
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $option);
    $row = mysqli_fetch_array($get_email_query);
    $email = $row["email"];
    $query = $dbClient->mysqli_query_func("UPDATE users SET password='$password_hashed' WHERE email='$email'");

    if($query) {
        $query = $dbClient->mysqli_query_func("DELETE FROM reset_password_codes WHERE code='$code'"); // Switch to update when is clicked
        exit("Password Updated!");
    } else {
        exit("Password Failed to update!");
    }
}
?>
</br>
<form method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Reset password</label>
        <input type="password" name="password" autocomplete="off" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter password">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Update password" class="btn btn-dark btn-block w-100">
    </div>
</form>

<?php include '../utilities/footer.php'; ?>