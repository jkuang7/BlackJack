<?php
if(isset($_POST['signup'])) {
    require 'database_handler.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    
    /* Empty Fields */
    if(empty($username) || empty($email) || empty($password) || empty($full_name)) {
        header("Location: ../signup.php?error=emptyfields?fsdfsdf");
        exit();
    }
    /* invalid email and username */
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername_invalidemail&full_name=".$full_name);
        exit();
    }
    /* invalid email */
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail&username=".$username."&full_name=".$full_name);
        exit();
    }
    /* invalid username */
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername&email=".$email."&full_name=".$full_name);
        exit();
    }
    else {
        /* SQL Injection for valid form */
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            /* Query for duplicate users */
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            /* if there is already an existing user, send error link */
            if($resultCheck > 0) {
                header("Location: ../signup.php?error=userTaken&email=".$email."&full_name=".$full_name);
                exit();
            }
            else {
                /* SQL to insert user  */
                $sql = "INSERT INTO users(username, password, email, full_name) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                /* SQL Injection */
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashPwd = password_hash($password, PASSWORD_DEFAULT); //hash for password
                    mysqli_stmt_bind_param($stmt, "ssss", $username, $hashPwd, $email, $full_name);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    /* Redirect user if they access "../includes/login.inc.php" without clicking on the sign up button -> send them back */
    header("Location: ../signup.php");
    exit();
}