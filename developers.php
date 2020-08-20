<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlackJack</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
     h1{
        color:rgb(207, 75, 75);
        text-align: center;
        text-indent: 20px;
        padding: 20px;
        margin-left: auto;
        margin-right: auto;
     }
     #profile {
        text-align: center;
        border-collapse: separate;
        border-spacing: 50px;
     }
     #header {
        color : white;
     }
    .header-column {
        text-align: center;
     }
    .profile-cell {
        color: #08020267;
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
<body>
  <?php
      include_once 'includes/navbar.php';
  ?>
  
<h1>Meet the Developers</h1>
<br><br>
<table class="profile-table">
  <tr class="profile-row">
      <td class="profile-cell" type= "img"><img src= images/Jian.jpg width="194" height="297.96132359260850880962612806188"><p>Jian Kuang</p></td>
      
      <td class="profile-cell" type="profile-text">I'm currently a senior at CUNY Queens College studying for a Computer Science B.A. For this particular Blackjack project website, I am both the project manager and the backend engineer.<br><br>
        Currently, I am especially interested in Data Science and Machine Learning. I believe there is much potential and value in mining and utilizing Big Data from the market to develop valuable insights, and to determine the productive goals to be pursued for the purposes of solving important problems in the world.<br><br>
        Other varied interests of mine include psychology and psychiatry, history, philosophy, business and economics (finance), as well as English literature.<br><br>
        During my free time I like to read, play games, watch YouTube videos, travel and explore.
        I have a passion for teaching and learning. 
        For sports, I play volleyball and basketball.</td>
  </tr>
  <tr class="profile-row">
    <td class="profile-cell" type= "img"><img src= images/MEidi.jpeg width="194" height="394.125"><p>Meidi Bi</p></td>
    <td class="profile-cell" type="profile-text" id = "meidip">I'm a Computer Science B.A. student at Queens College. I'm responsible for the front-end development of this CS355 term project. I'm mainly interested in creating a product that is enjoyable and appealing to the user. Functionality is a must but a beautiful design has the advantage.<br><br>
      I take interest in motor vehicle design and architecture and appreciate art in these forms. My sign is Sagittarius and I was born in the year of the Rat.
      <br><br>
      My life goal is to have a stable career and work towards opening a cafe. In my free time I enjoy singing, watching YouTube videos, trying new foods, traveling to new places.
    </td>
  </tr>
</table>
</body>
</html>