<?php
include('../db.php');
$dbClient = new DatabaseClient();

if(!isset($_GET["code"])) {
    exit("Cannot find page!");
}

$code = $_GET["code"];
$get_email_query = $dbClient->mysqli_query_func("SELECT email FROM reset_password_codes WHERE code='$code'");

//if(!mysqli_num_rows($get_email_query) == 0) {
//    exit("Cannot find page!11111");
//}
if(isset($_POST["password"])) {
    // Add error validation
    $password = $_POST["password"];
//    $password = md5($_POST["password"]); // REPLACE ENCRYPTION!!!!!
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

<form method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Reset password</label>
        <input type="password" name="password" autocomplete="off" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter password">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Update password">
    </div>
    <!--    <div class="form-group">-->
    <!--        <label for="exampleInputPassword1">Password</label>-->
    <!--        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
    <!--    </div>-->
    <!--    <div class="form-check">-->
    <!--        <input type="checkbox" class="form-check-input" id="exampleCheck1">-->
    <!--        <label class="form-check-label" for="exampleCheck1">Check me out</label>-->
    <!--    </div>-->
    <!--    <button type="submit" class="btn btn-primary">Submit</button>-->
</form>
