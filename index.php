<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlackJack</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <style>
    body, html {
      height: 100%;
      font-family: Arial, Helvetica, sans-serif;
      overflow-y: hidden;
      background-color: rgb(85,150,85);
    }
    * {
      box-sizing: border-box;
    }
    .bg-img{
      background-image: url(images/BlackJack.png);
      background-position: center center;
      background-repeat: no-repeat;
      background-attachment: absolute;
      overflow-y: hidden;
      -webkit-background-size: contain;
      -moz-background-size: contain;
      -o-background-size: contain;
      background-size: contain;
      z-index:9999;
    }
    .container {
      position: relative;

    }
    h1{
      color: #08020267;
      text-align: center;
    }
    p{
      color: white;
    }
    td {
      height: 1200px;
    }
    
    input[type=submit] {
      width: 20%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type=submit]:hover {
      background-color: #45a049;
    }
    button {
      background-color: #15b807; /* Green */
      box-shadow: 0 5px #108006;
      cursor: pointer;
      border: none;
      outline: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 15px;
    }
    button[class="bigplay"]{
      font-size: 70px;
    }
    form {
      text-align: center;
      border-collapse: separate;
      margin-left: auto;
      margin-right: auto;
      margin-top: 15%;
      font-size: 120%;
    }
  </style>
</head>
<body>
<?php
    include_once 'includes/navbar.php';
?>

<div id="menu" class="bg-img">
    <form class="container">
      <button id = "playbtn" class="bigplay" type="button" onclick="window.location.href='project.php'">PLAY</button>
      <br><br>
      <button id = "login" type="button" onclick="window.location.href='login.php'">Login</button>
      <br><br>
      <button id = "how2playbtn" type="button" onclick="window.location.href='rules.php'">How To Play</button>
      <br><br>
      <button id = "signupbtn" type="button" onclick="window.location.href='signup.php'">Sign Up</button>
      <br><br>
  </form>
</div>

<script type="text/javascript">
  /* update playbtn on front-page to go to game if logged in */
  var x = <?php echo json_encode($_SESSION); ?>;
  var playbtn = document.getElementById("playbtn");
  
  if((x['username']) != null && playbtn != null) {
      playbtn.setAttribute("onclick", "javascript: window.location.href='project.php'");
      console.log(x);
  }
  
</script>
</body>
</html>