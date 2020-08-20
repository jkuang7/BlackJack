<?php
  include_once 'includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlackJack</title>
  <link rel="stylesheet" name="text/css" href="style.css">
  <script src="javascript/jquery-3.5.1.min.js"></script>

  <style>
     html{
      background-image: url(images/greenback.png);
      background-repeat: repeat;
      background-position: center 80%;
    }
    body {
      height: 100%;
    }
     h1{
        color: white;
        text-align: center;
     }
     p{
        color: white;
     }
     #board {
        text-align: center;
        border-collapse: separate;
        border-spacing: 20px;
        margin-left: auto;
        margin-right: auto;
     }
     #header {
         color : white;
     }
    .header-col-umn {
     text-align: center;
     }
    .board-cell {
        color : white;
    }
    
    p.solid {
      border-style: solid;
      border-width: thin 350px;
    }
    td {
      height: 22px;
    }
  </style>
</head>

<script src = "javascript/blackjack.js"></script>

<body onload="newGame()">
  <h1>BLACKJACK</h1>

<?php
  /* queries data from the database to load into the document */
    if(isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
      $sql = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION['gamestatus'] = $row['gamestatus'];
            $_SESSION['bankroll'] = $row['bankroll'];
            $_SESSION['betting'] = $row['betting'];
        }
      }
    } else {
      $_SESSION['username'] = "test";
      $_SESSION['gamestatus'] = "Place Your Bets!";
      $_SESSION['bankroll'] = 2000;
      $_SESSION['betting'] = 0;
    }
?>

<table id ="board">
    <tr class = "board-row">
      <td class="board-cell" name="text-row" id="betting">Betting: </td>
      <td class="board-cell" name="text-row" id="bankroll">Bankroll: </td>
      <td class="board-cell" name="text-row" id="status"><a id = "status">Status: </a></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
  </tr>
  </table> 

   <table id="board">
    <tr class = "board-row">
    <td class="board-cell"><button id="1" name="button" class="board-chip" onclick="betting1()"><img src="images/chip1.png" width=75></button></td>        
        <td class="board-cell" name="text-row">Player's Hand:</td>
        <td class="board-cell" name="card" id="card-row-0-col-0"></td>
        <td class="board-cell" name="card" id="card-row-0-col-1"></td>
        <td class="board-cell" name="card" id="card-row-0-col-2"></td>
        <td class="board-cell" name="card" id="card-row-0-col-3"></td>
        <td class="board-cell" name="card" id="card-row-0-col-4"></td>
        <td class="board-cell" name="card" id="card-row-0-col-5"></td>
        <td class="board-cell" name="card" id="card-row-0-col-6"></td>
        <td class="board-cell" name="card" id="card-row-0-col-7"></td>
        <td class="board-cell" name="card" id="card-row-0-col-8"></td>
        <td class="board-cell" name="card" id="card-row-0-col-9"></td>
        <td class="board-cell" name="card" id="card-row-0-col-10"></td>
        <td class="board-cell" name="text-row" id ="playersum">0</td>
    </tr>

    <tr class = "board-row">
    <td class="board-cell"><button id="10" name="button" class="board-chip" onclick="betting10()"><img src="images/chip10.png" width=75></button></td>
        
        <td class="board-cell" name="text-row">Player's Split:</td>
        <td class="board-cell" name="card" id="card-row-1-col-0"></td>
        <td class="board-cell" name="card" id="card-row-1-col-1"></td>
        <td class="board-cell" name="card" id="card-row-1-col-2"></td>
        <td class="board-cell" name="card" id="card-row-1-col-3"></td>
        <td class="board-cell" name="card" id="card-row-1-col-4"></td>
        <td class="board-cell" name="card" id="card-row-1-col-5"></td>
        <td class="board-cell" name="card" id="card-row-1-col-6"></td>
        <td class="board-cell" name="card" id="card-row-1-col-7"></td>
        <td class="board-cell" name="card" id="card-row-1-col-8"></td>
        <td class="board-cell" name="card" id="card-row-1-col-9"></td>
        <td class="board-cell" name="card" id="card-row-1-col-10"></td>
        <td class="board-cell" name="text-row" id="playersplit">0</td>
    </tr>

    <tr class = "board-row">
    <td class="board-cell"><button id="20" name="button" class="board-chip" onclick="betting20()"><img src="images/chip20.png" width=75></button></td>
       
        <td class="board-cell" name="text-row">Dealer's Hand:</td>
        <td class="board-cell" name="card" id="card-row-2-col-0"></td>
        <td class="board-cell" name="card" id="card-row-2-col-1"></td>
        <td class="board-cell" name="card" id="card-row-2-col-2"></td>
        <td class="board-cell" name="card" id="card-row-2-col-3"></td>
        <td class="board-cell" name="card" id="card-row-2-col-4"></td>
        <td class="board-cell" name="card" id="card-row-2-col-5"></td>
        <td class="board-cell" name="card" id="card-row-2-col-6"></td>
        <td class="board-cell" name="card" id="card-row-2-col-7"></td>
        <td class="board-cell" name="card" id="card-row-2-col-8"></td>
        <td class="board-cell" name="card" id="card-row-2-col-9"></td>
        <td class="board-cell" name="card" id="card-row-2-col-10"></td>
        <td class="board-cell" name="text-row" id="dealersum">0</td>
    </tr>

    <tr class = "board-row">
    <td class="board-cell"><button id="100" name="button" class="board-chip" onclick="betting100()"><img src="images/chip100.png" width=75></button></td>
        
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
        <td class="board-cell" name="text-row"></td>
    </tr>

    <tr class = "board-row">
    <td class="board-cell"><button id="500" name="button" class="board-chip" onclick="betting500()"><img src="images/chip500.png" width=75></button></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell" name="text-row"></td>
    </tr>

    <tr class = "board-row">
        <td class="board-cell"><button id="reset" name="button" class="actionbtn" onclick="reset()">RESET</button></td>
        <td class="board-cell"></td>
        <td class="board-cell"><button id ="hit" name="button" class="actionbtn" onclick="hit()" style="">HIT</button></td>
        <td class="board-cell"><button id="stand" name="button" class="actionbtn" onclick="stand()" style="">STAND</button></td>
        <td class="board-cell"><button name="button" id="split" class="actionbtn" onclick = "split()" style="">SPLIT</button></td>
        <td class="board-cell"><button name="button" id="save" class="actionbtn" onclick="save()" style="">SAVE</button></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell"></td>
        <td class="board-cell" name="text-row"></td>
    </tr>

  <tr class = "board-row">
      <td class="board-cell"><button id="dd" name="button" class="actionbtn" onclick="doubleDown()" style="">DOUBLE DOWN</button></td>
      <td class="board-cell"></td>
      <td class="board-cell"><button id="resetgame" name="button" class="actionbtn" onclick="resetGame()">NEW GAME</button></td>
      <td class="board-cell"><button id="deal" name="button" class="actionbtn" onclick="dealingPhase()">DEAL</button></td>
      <td class="board-cell"><button id="continue" name="button" class="actionbtn" onclick="cont()">CONTINUE</button></td>
      <td class="board-cell"><button name="button" id="load" class="actionbtn" onclick="load()" style="">LOAD</button></td>
      <input id="file-input" type='file' style="visibility:hidden;" onchange="readFile(event)"/>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell"></td>
      <td class="board-cell" name="text-row"></td>
  </tr>

<script>
      var x = <?php echo json_encode($_SESSION); ?>;
      /* Pulling information from session and putting it in the HTML document */
      document.getElementById("status").innerHTML = "Status: " + x['gamestatus'];
      document.getElementById("bankroll").innerHTML = "Bankroll: $" + x['bankroll'];
      document.getElementById("betting").innerHTML = "Betting: $" + x['betting'];
      var _bankroll = document.getElementById("bankroll");
      var _betting = document.getElementById("betting");
      
      if(_bankroll.value == undefined || _bankroll.value == null || _betting.value == undefined || _betting.value == undefined) {
        _bankroll.value = parseInt(x['bankroll']);
        _betting.value = parseInt(x['betting']);
      }
      //Continue Button
      $(document).ready(function() {
        $("#continue").click(function() {
        var x = document.getElementById("bankroll").value;
        var y = document.getElementById("betting").value;
        var z = document.getElementById("user").value;
        
        $.ajax({
          type: "POST",
          url: "includes/updateDatabase.php",
          data: { bankroll: x, betting: y, username: z }
        });
      });    
      
      //Reset Game
      $("#resetgame").click(function() {
        var x = document.getElementById("bankroll");
        var y = document.getElementById("betting");
        
      });
    });
</script>

<script>
  var x = document.getElementById("bankroll");
  var y = document.getElementById("betting");
  //updating bankroll and betting field from session
  $(document).ready(function() {
      var session = <?php echo json_encode($_SESSION); ?>;
      x.value = parseInt(session['bankroll']);
      y.value = parseInt(session['betting']);
      x.innerHTML = "Bankroll: $" + x.value;
      y.innerHTML = "Betting: $" + y.value;
    });
  </script>

</body>
</html>