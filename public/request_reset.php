<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('../db.php');
include('../utilities/header.php');
require '../vendor/autoload.php';
$dbClient = new DatabaseClient();

if (isset($_POST['email'])) {
    $email_to = $_POST['email'];

    $code = uniqid(true);
    $query = $dbClient->mysqli_query_func("INSERT INTO reset_password_codes(code, email) VALUES('$code', '$email_to')");
    $password_email = 'xgfjjjrvwagrxhwy';
    if (!$query) {
        exit("Error");
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'phptesttestov@gmail.com';                     //SMTP username
        $mail->Password = $password_email;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('phptesttestov@gmail.com', 'RG_Mailer');
        $mail->addAddress($email_to);     //Add a recipient
        $mail->addReplyTo('no-reply@example.com', 'No reply');

        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/reset_password.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'eCards Platform Reset Password';
        $mail->Body = "Requested password reset link. Click <a href='$url'>Link</a>  ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Reset password link has been sent to your email';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit(); // if form was submitter (successful of not) the form down will not show - nothing will be renderd after
}

?>

</br>
<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" name="email" autocomplete="off" class="form-control" id="exampleInputEmail1"
               aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Reset email" class="btn btn-dark btn-block w-100">
    </div>
</form>

<?php include '../utilities/footer.php'; ?>