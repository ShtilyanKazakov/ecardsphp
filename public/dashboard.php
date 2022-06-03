<?php

require_once('../db.php');
require_once("../utilities/header.php");
require_once("../utilities/footer.php");
//include('../includes/login.php');
$errors = array();
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) { ?>
    
        <h1>Hello, <?php echo $_SESSION['username'];  ?></h1>
        <a href="logout.php">Logout</a>
<?php
} else {
    echo 'There is no user in session!';
}
?>