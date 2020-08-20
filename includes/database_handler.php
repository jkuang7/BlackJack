<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "pokerface";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// $dbServername = "mars.cs.qc.cuny.edu: 3306";
// $dbUsername = "kuji0700";
// $dbPassword = "23370700";
// $dbName = "kuji0700";
// $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// $dbServername = "us-cdbr-east-02.cleardb.com";
// $dbUsername = "b172fae6a51ed5";
// $dbPassword = "63c0ad12";
// $dbName = "heroku_8f1c5941b4063e2";
// $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
