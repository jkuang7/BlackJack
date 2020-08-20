<?php
include 'database_handler.php';

$bankroll = $_POST["bankroll"];
$betting = $_POST["betting"];
$username = $_POST["username"];

if(isset($bankroll) && isset($betting) && isset($username)) {
    $sql = "UPDATE users SET bankroll=$bankroll, betting=$betting\n"."\n"."WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    $_SESSION['bankroll'] =  $bankroll;
    $_SESSION['betting'] = $betting;
} else {
    echo "Database failure!";
}