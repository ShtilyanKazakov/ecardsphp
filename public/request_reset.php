<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('../db.php');

//Load Composer's autoloader
require '../vendor/autoload.php';
$dbClient = new DatabaseClient();
if (isset($_POST['email'])) {
    $email_to = $_POST['email'];

    $code = uniqid(true);
    $query = $dbClient->mysqli_query_func("INSERT INTO reset_password_codes(code, email) VALUES('$code', '$email_to')");

    if (!$query) {
        exit("Error");
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = '';                     //SMTP username
        $mail->Password = '';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('', '');
        $mail->addAddress($email_to);     //Add a recipient
//    $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('no-reply@example.com', 'No reply');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

        //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/reset_password.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'eCards Platform Reset Password';
        $mail->Body = "Requested password reset link: $code Click Link <a href='$url'>link</a>  ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Reset password link has been sent to your email';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit(); // if form was submitter (successful of not) the form down will not show - nothing will be renderd after
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" name="email" autocomplete="off" class="form-control" id="exampleInputEmail1"
               aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Reset email">
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
</body>
</html>
