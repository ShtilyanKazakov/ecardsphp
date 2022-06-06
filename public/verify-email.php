<?php
include('../db.php');
$dbClient = new DatabaseClient();

if($_GET['code'] && $_GET['token']) {
    $email = $_GET['code'];
    $token = $_GET['token'];
    $query = $dbClient->mysqli_query_func("SELECT * FROM users WHERE email_verification_link='$token' AND email='$email'");
    $d = date('Y-m-d H:i:s');
//    if (mysqli_num_rows($query) > 0) {
        $row= mysqli_fetch_array($query);
        if($row['email_verified_at'] == NULL){
            $dbClient->mysqli_query_func("UPDATE users set email_verified_at ='$d' WHERE email='$email'");
            $msg = "Congratulations! Your email has been verified.";
        }else{
            $msg = "You have already verified your account with us";
        }
//    }
//    else {
//        $msg = "This email has been not registered with us";
//    }
}
else
{
    $msg = "Danger! Your something goes to wrong.";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Account Activation by Email Verification using PHP</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-3">
    <div class="card">
        <div class="card-header text-center">
            User Account Activation by Email Verification using PHP
        </div>
        <div class="card-body">
            <p><?php echo $msg; ?></p>
        </div>
    </div>
</div>
</body>
</html>