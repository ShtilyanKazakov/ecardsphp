<?php

session_start();

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
    $code = uniqid(true); // TOKEN SHOULD EVERYTIME BE UNIQUE
//    $email_array = [$dbClient->real_escape_string($_POST['email'])]; // sql injection
//    $emails_to_list = implode(", ", $email_array);
    $email_to = $dbClient->real_escape_string($_POST['email']);
    $user_in_session_id = $_SESSION['user_id'];
    $username_in_session = $_SESSION['username'];

    $description_card = htmlspecialchars($_POST['description_card']); // changes

    $card_id_get = $dbClient->real_escape_string($_POST['card_id']); // sql injection
    $query = $dbClient->mysqli_query_func("INSERT INTO send_card(user_id, card_id, code, description_card, recipient_email) VALUES('$user_in_session_id', '$card_id_get', '$code', '$description_card', '$email_to');");
//    var_dump($user_in_session_id);
//    var_dump($card_id_get);
//    var_dump($code);
    $password_email = 'xgfjjjrvwagrxhwy';
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
        $mail->Username = 'phptesttestov@gmail.com';                     //SMTP username
        $mail->Password = $password_email;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('phptesttestov@gmail.com', 'RG_Mailer');
        $mail->addAddress($email_to);     //Add a recipient
        $mail->addReplyTo('no-reply@example.com', 'No reply');

        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . "/ecards-sending-cards/public" . "/greetings-view.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'eCards Platform - Sending you gift Cards';
        $mail->Body = "See your gift card. Click <a href='$url'>Link</a>, sent by: '$user_in_session_id'  ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Gift Card link has been sent to your email';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit(); // if form was submitter (successful of not) the form down will not show - nothing will be renderd after
}

?>
