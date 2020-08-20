<?php

if(isset($_POST['login'])) {
    require 'database_handler.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    /* Empty Fields */
    if(empty($username) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE username = ?;";
        $stmt = mysqli_stmt_init($conn);
        /* SQL Injection */
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else {
            /* account verification */
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['password']);

                /* false password */
                if($pwdCheck == false) {
                    header("Location: ../login.php?error=wrongpassword&username=".$username);
                    exit();
                }
                /* Start session and store the id and the username for the running session */
                elseif($pwdCheck == true) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['gamestatus'] = $row['gamestatus'];
                    $_SESSION['bankroll'] = $row['bankroll'];
                    $_SESSION['betting'] = $row['betting'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
            /* No existing user */
            else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
}
else {
    /* Redirect user if they access "../includes/login.inc.php" without clicking on the sign up button -> send them back */
    header("Location: ../login.php");
    exit();
}