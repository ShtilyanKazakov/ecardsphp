<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('../db.php');

//Load Composer's autoloader
require '../vendor/autoload.php';
$dbClient = new DatabaseClient();

if (isset($_POST['register']) && $_POST['email']) {
    $username = $dbClient->real_escape_string($_POST['username']);
    $email_to = $dbClient->real_escape_string($_POST['email']);
    $password = $dbClient->real_escape_string($_POST['password']);
    $result = $dbClient->mysqli_query_func("SELECT * FROM users WHERE email='" . $email_to . "'");
    $row = mysqli_num_rows($result);
    if ($row < 1) {
        $token = md5($email_to) . rand(10, 9999);
        $option = [
            'cost' => 12
        ];
        $password_email = '';
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $option);
        $dbClient->mysqli_query_func("INSERT INTO users (username, email, password, status, email_verification_link) VALUES('" . $username . "', '" . $email_to . "', '" . $password_hashed . "', 0, '" . $token . "')");
        $link2 = "http://" . $_SERVER["HTTP_HOST"] . "/ecards-sending-cards/public" . "/verify-email.php?code=" . $_POST['email']. "&token=" . $token . " ";
        $link = "<a href='$link2'>Click and Verify Email</a>";
//        require_once('phpmail/PHPMailerAutoload.php');
        $mail = new PHPMailer(true);
        $mail->CharSet = "utf-8";
        $mail->IsSMTP();
// enable SMTP authentication
        $mail->SMTPAuth = true;
// GMAIL username
        $mail->Username = 'eugenes.site19@gmail.com'; //SMTP username
        $mail->Password = $password_email;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
// sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
// set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->setFrom('eugenes.site19@gmail.com', 'Eugene_Mailer');
        $mail->AddAddress($email_to);
        $mail->addReplyTo('no-reply@example.com', 'No reply');
        $mail->Subject = 'Register via Email';
        $mail->IsHTML(true);
        $mail->Body = 'Click On This Link to Verify Email ' . $link . '';
        if ($mail->send()) {
            echo "Check Your Email box and Click on the email verification link.";
        } else {
            echo "Mail Error - >" . $mail->ErrorInfo;
        }
    } else {
        echo "You have already registered with us. Check Your email box and verify email.";
    }
}
