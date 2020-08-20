<?php
  session_start();
  include 'includes/database_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
      button[type="submit"] {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 5px 18px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
      }
      p {
        color: #08020267;
        font-weight: bold;
      }
      td {
        font-weight: bold;
        
      }
      p[class="loginStatus"] {
        color: magenta;
        font-weight: bold;
      }
      form[id="logout_form"]{
        margin:0;
        padding:0;
      }

      .nav {
        z-index: 9999;
        display: block;
      }

    </style>
</head>
<body>
<!-- NAVBAR BEGINS HERE-->
  <nav id="navbar">
    <ul>
      <div class="dropdown-left">
        <a href="index.php"><img class="pull-left" src="images/logo.svg" width="50"></a>
      </div>

      <li class="dropdown">
        <a id="a_index" href="index.php" class="w3-container">Play</a>
        <div class ="dropdown-content"></div>
      </li>

      <li class="dropdown">
          <a href="rules.php" class="w3-container">Rules of the Game</a>
      </li>

      <li class="dropdown">
        <a href="developers.php" class="w3-container">About</a>
        <div class="dropdown-content">
          <a href="developers.php">Meet the Developers</a>
          <a href="briefhistory.php">Brief History of Blackjack</a>

          <a href="https://www.google.com/search?q=blackjack" target="_blank">Google Search</a>
        </div>
      </li>

      <li class="dropdown">
        <a href="imagescramble.php" class="w3-container">Other Websites</a>
        <div class="dropdown-content">
          <a href="imagescramble.php">Image Scramble</a>
          <a href="https://www.247blackjack.com/" target="_blank">247blackjack</a>
          <a href="https://www.arkadium.com/games/blackjack/" target="_blank">Arkadium</a>
          <a href="https://play.google.com/store/apps/details?id=com.genina.android.blackjack.view&hl=en_US" target="_blank">Blackjack Mobile (Android)</a>
          <a href="https://apps.apple.com/us/app/blackjack/id366459988" target="_blank"> Blackjack Mobile (IOS)</a>
        </div>
      </li>

      <li class="dropdown">
        <a href="contact.php" class="w3-container">Contact Us</a>
      </li>
    </ul>
  </nav>
<!--NAVBAR ENDS HERE-->

<?php
  if(isset($_SESSION['id'])) {
    echo '<p id="user" class="loginStatus" style ="text-align: right; color=white">'.$_SESSION['username'].' is logged in!</p>';
  } else {
    echo '<p class="loginStatus" style ="text-align: right; color=white">You are logged out!</p>';
    echo '<p class="loginStatus" style ="text-align: right; color=white"> Want to save your game progress? <a href="signup.php">Sign up</a></p>';
    echo '<p class="loginStatus" style ="text-align: right; color=white"> Have an account already? <a href="login.php">Sign in</a></p>';
  }
?>

<form id="logout_form" action ="includes/logout.inc.php" method="POST" style="text-align: right">
  <?php
    if(isset($_SESSION['id'])) {
      echo '<button type = "submit" name="logout">Logout</button>';
    }
  ?>
</form>

<script type="text/javascript">
      var x = <?php echo json_encode($_SESSION); ?>;
      /* update play nav bar to go to game if logged in */
      if(x['username'] != null) {
        var a_index = document.getElementById("a_index");
        if(a_index != null)
          a_index.href = "project.php";
        var loginUser = document.getElementById("user").value = x['username'];
      }


</script>

</body>
</html>
