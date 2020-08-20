<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
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
      background-size: 100% 100%;
      background-repeat: no-repeat;
      background-attachment: absolute;
      min-height: 80%;
      min-width: 100%;
      overflow-y: hidden;
      -webkit-background-size: contain;
      -moz-background-size: contain;
      -o-background-size: contain;
      background-size: contain;
      z-index:9999;
    }
    .inputcontainer {
      top: 50%;
    }
     h1{
        color: #08020267;
        text-align: center;
     }
     p{
        color: black;
     }
    td {
      height: 1200px;
    }

    input[type=text], input[type="password"],  select {
      width: 20%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
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

     form {
        text-align: center;
        border-collapse: separate;
        border-spacing: 20px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 15%;
        font-size: 120%;
        position: relative;
     }

     button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 5px 18px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
      }
  </style>
</head>
<body>
<?php
    include_once 'includes/navbar.php';
  ?>
  <div class="bg-img">
    <form action="includes/signup.inc.php" method="POST" class="inputcontainer">
        <input id="full_name" type="text" name="full_name" value="" placeholder="Full Name">
        <br>
        <input id="email" type="text" name="email" value="" placeholder="E-Mail">
        <br>
        <input id="username" type="text" name="username" value="" placeholder="Username">
        <br>
        <input id="password" type="password" name="password" value="" placeholder="Password">
        <br><br>
        <button type="submit" name="signup">Sign Up</button>
        <br><br>
        <p>Already have an account? <a href="login.php">Sign in</a></p>
        <br><br>
        

        <?php
          if(isset($_GET['error'])) {
            if($_GET['error'] == "emptyfields") {
              echo('<p class="signuperror" style="color: red">Fill in all fields!</p>');
            }
            elseif($_GET['error'] == "invalidemail_invalidusername") {
              echo('<p class="signuperror" style="color: red">Invalid username and e-mail!</p>');
            }
            elseif($_GET['error'] == "invalidusername") {
              echo('<p class="signuperror" style="color: red">Invalid username!</p>');
            }
            elseif($_GET['error'] == "invalidemail") {
              echo('<p class="signuperror" style="color: red">Invalid e-mail!</p>');
            }
            elseif($_GET['error'] == "usertaken") {
              echo('<p class="signuperror" style="color: red">Username is already taken!</p>');
            }
          }
          if(isset($_GET['signup'])) {
            if($_GET['signup'] == "success") {
              echo('<p class="signuperror" style="color: rgb(57,255,20);">Signup Successful</p>');
            }
          }
        ?>

        <script type="text/javascript">
          var get = <?php echo json_encode($_GET); ?>;;
            if(get['full_name'] != null)
              document.getElementById("full_name").value=get['full_name'];
            if(get['email'] != null)
              document.getElementById("email").value=get['email'];
            if(get['username'] != null)
              document.getElementById("username").value=get['username'];
        </script>
    </form>
  </div>

</body>
</html>