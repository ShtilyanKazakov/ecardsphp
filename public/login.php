<?php

//include('../includes/login.inc.php');
include('../utilities/header.php');
include('../db.php');

$dbClient = new DatabaseClient();

// Set vars to empty values
$username = $password = '';
$usernameErr = $passwordErr = $credentialErr = '';

if (isset($_POST['login'])) {

    // Validate name
    if (empty($_POST['username'])) {
        $usernameErr = 'Username is required';
    } else {
        $username = $dbClient->real_escape_string(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    }

    // Validate password
    if (empty($_POST['password'])) {
        $passwordErr = 'Password is required';
    } else {
        $password = $dbClient->real_escape_string($_POST['password']);
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        
        $query = "SELECT * FROM users WHERE username='$username'";
        $results = $dbClient->mysqli_query_func($query);
        $user = mysqli_fetch_assoc($results);

        if (mysqli_num_rows($results) == 1) {
            if (!empty($user['email_verified_at'])) {
                if ($user['username'] == $username  || password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["user_id"] = $user['id'];
                    $_SESSION["username"] = $user['username'];  
                    header("Location: index.php");
                }else{
                    $credentialErr = 'Username or password is incorrect!';
                }
            } else {
                $credentialErr = 'Email address not verified!';
            }
        }   
    }
}
?>
</br>
<h2>Login</h2>
<form class="mt-4 w-75" method="POST" action="">
    <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input type="text" class="form-control <?php echo !$usernameErr ?:
                                                    'is-invalid'; ?>" id="username" name="username" placeholder="Enter your username" value="<?php echo $username; ?>">
        <div class="invalid-feedback">
            <?php echo $usernameErr; ?>
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
    <div style="color: #FF0000">
        <?php echo $credentialErr; ?>
    </div>
    <div class="mb-3">
        <input type="submit" name="login" value="Login" class="btn btn-dark btn-block w-100">
    </div>
    <p class="text-center text-muted mt-5 mb-0">Forgot your password? <a href="request_reset.php" class="fw-bold text-body"><u>Forgotten password</u></a></p>
    <p class="text-center text-muted mt-5 mb-0">Do not have an account? <a href="register.php" class="fw-bold text-body"><u>Register here</u></a></p>
</form>
<?php include '../utilities/footer.php'; ?>