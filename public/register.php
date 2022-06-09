<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

include '../utilities/header.php';
include_once('../db.php');
require '../vendor/autoload.php';

$dbClient = new DatabaseClient();

// Set vars to empty values
$username = $email = $password = $repeat_password = '';
$usernameErr = $emailErr = $passwordErr = $repeatpasswordErr = $matchingpasswordsErr = '';

// Form submit
if (isset($_POST['register'])) {

  // Validate name
  if (empty($_POST['username'])) {
    $usernameErr = 'Username is required';
  } elseif (mysqli_num_rows($dbClient->select('users', ['*'], "username='" . $_POST['username'] . "'")) > 0) {
    $usernameErr = 'Username is already taken';
  } else {
    $username = $dbClient->real_escape_string(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  }

  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } elseif (mysqli_num_rows($dbClient->select('users', ['*'], "email='" . $_POST['email'] . "'")) > 0) {
    $emailErr = 'Email has already been used';
  } else {
    $email = $dbClient->real_escape_string(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
  }

  // Validate password
  if (empty($_POST['password'])) {
    $passwordErr = 'Password is required';
  } else {
    $password = $dbClient->real_escape_string($_POST['password']);
  }

  if (empty($_POST['repeat_password'])) {
    $repeatpasswordErr = 'Repeat password is required';
  } else {
    $repeat_password = $dbClient->real_escape_string($_POST['repeat_password']);
  }

  if ($password != $repeat_password) {
    $matchingpasswordsErr = "The passwords you have entered do not match";
  }

  if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatpasswordErr) && empty($matchingpasswordsErr)) {
    $token = md5($email) . rand(10, 9999);
    $password_email = 'xgfjjjrvwagrxhwy';
    $link_assembly = "/project/ecardsphp/public";
    $option = [
      'cost' => 12
    ];
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $option);
    $insert_query = $dbClient->insert(
      'users',
      [
        'username',
        'email',
        'password',
        'status',
        'email_verification_link'
      ],
      [
        $username,
        $email,
        $password_hashed,
        0,
        $token
      ]
    );
    $link2 = "http://" . $_SERVER["HTTP_HOST"] . $link_assembly . "/verify-email.php?code=" . $_POST['email'] . "&token=" . $token . " ";
    $link = "<a href='$link2'>Click this to verify your account</a>";
    $mail = new PHPMailer(true);
    $mail->CharSet = "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    // GMAIL username
    $mail->Username = 'phptesttestov@gmail.com';
    $mail->Password = $password_email;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "465";
    $mail->setFrom('phptesttestov@gmail.com', 'Ecards_Registration');
    $mail->AddAddress($email);
    $mail->addReplyTo('no-reply@example.com', 'No reply');
    $mail->Subject = 'Ecards Platform Registration Email Verification';
    $mail->IsHTML(true);
    $mail->Body = 'A user account has been created on the Ecards platform with this email. If this was you click this link to verify ' . $link . '';
    if (!$mail->send()) {
      echo "Mail Error - >" . $mail->ErrorInfo;
    }
  }
  header('location: post_register.php');
}
?>
</br>
<h2>Register</h2>
<span style="color: #FF0000"> All fields are required </span>
<form method="POST" action="<?php echo htmlspecialchars(
                              $_SERVER['PHP_SELF']
                            ); ?>" class="mt-4 w-75">
  <div class="mb-3">
    <label for="name" class="form-label">Username</label>
    <input type="text" class="form-control <?php echo !$usernameErr ?:
                                              'is-invalid'; ?>" id="username" name="username" placeholder="Enter your username" value="<?php echo $username; ?>">
    <div class="invalid-feedback">
      <?php echo $usernameErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control <?php echo !$emailErr ?:
                                              'is-invalid'; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
    <div class="invalid-feedback">
      <?php echo $emailErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Password</label>
    <input class="form-control <?php echo !$passwordErr ?:
                                  'is-invalid'; ?>" type="password" name="password" id="password" placeholder="Enter your password" />
    <div class="invalid-feedback">
      <?php echo $passwordErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Repeat Password</label>
    <input class="form-control <?php echo !$repeatpasswordErr ?:
                                  'is-invalid'; ?>" type="password" name="repeat_password" id="repeat_password" placeholder="Repeat your password" />
    <div class="invalid-feedback">
      <?php echo $repeatpasswordErr; ?>
    </div>
  </div>
  <div style="color: #FF0000">
    <?php echo $matchingpasswordsErr; ?>
  </div>
  <div class="mb-3">
    <input type="submit" name="register" value="Register" class="btn btn-dark btn-block w-100">
  </div>
</form>
<p class="text-center text-muted">Already have an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
<?php include '../utilities/footer.php'; ?>