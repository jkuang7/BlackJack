<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlackJack</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="javascript/jquery-3.5.1.min.js"></script>
  <style>
     h1{
        color:rgb(207, 75, 75);
        text-align: center;
        padding: 20px;
        margin: auto;
     }
     p{
        color: #08020267;
        font-weight: bold;
        margin: auto;
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

    /* Customize the label (the container) */
    .container {
      display: block;
      position: relative;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: relative;
      background-color: #ccffcc;
      height: 25px;
      width: 25px;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
      background-color: #ffcccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
      background-color: #ccccff;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }

      /* image scramble */
  .scramble-table {
    margin: auto;
    float: center;
    overflow-x: hidden;
    overflow-y: hidden;
  }

  .scramble-td {
    height: 154px;
    width: 100px;
    display: inline-block;
    border-collapse: collapse;
  }

  .scramble-td[img] {
    border-collapse: collapse;
    /*border: 1px solid #08020267;*/
    display: inline-flex;
    align-items: center;
    flex-wrap: wrap;
    margin-right: -2px;
    margin-left: -3px;
  }

  .scramble-td button {
    width: 97px;
    height: 45px;
    background: rgb(167,127,82);
    color: white;
  }
  </style>
</head>
<body onload = "resetGame(9)">
  <?php
    include_once 'includes/navbar.php';
  ?>


  
<h1>Image Scramble</h1>

<table class="scramble-table" cellspacing="0" cellpadding="0">
  <tr class="scramble-row">
    <td class ="scramble-td">
      <label class="container">
        <input type="checkbox" id = "scramble_images/row-1-col-1" name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
        <span class="checkmark"></span>
        <img src= scramble_images/row-1-col-1.jpg width="100" height="154" id = "scramble_images/row-1-col-1.jpg" name = "scramble_img">
      </label>
    </td>
    <td class ="scramble-td">
      <label class="container">
        <input type="checkbox" id = "scramble_images/row-1-col-2"  name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
        <span class="checkmark"></span>
        <img src= scramble_images/row-1-col-2.jpg width="100" height="154" id = "scramble_images/row-1-col-2.jpg" name = "scramble_img">
      </label>
    </td>
    <td class ="scramble-td">
      <label class="container">
        <input type="checkbox" id = "scramble_images/row-1-col-3" name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
        <span class="checkmark"></span>
        <img src= scramble_images/row-1-col-3.jpg width="100" height="154" id = "scramble_images/row-1-col-3.jpg" name = "scramble_img">
      </label>
    </td>
      <td class="scramble-td" type= "text"></td>
      <td class="scramble-td"><a id="status">Status: </a><br><br><a id="turn_status">Turn: 0</a></td>
  </tr>

  <tr class="scramble-row">
    <td class ="scramble-td">
      <label class="container">
        <input type="checkbox" id = "scramble_images/row-2-col-1" name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
        <span class="checkmark"></span>
        <img src= scramble_images/row-2-col-1.jpg width="100" height="154" id = "scramble_images/row-2-col-1.jpg" name = "scramble_img">
      </label>
    </td>
    <td class ="scramble-td">
      <label class="container">
        <input type="checkbox" id = "scramble_images/row-2-col-2"  name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
        <span class="checkmark"></span>
        <img src= scramble_images/row-2-col-2.jpg width="100" height="154" id = "scramble_images/row-2-col-2.jpg" name = "scramble_img">
      </label>
    </td>
    <td class ="scramble-td">
      <label class="container">
        <input type="checkbox" id = "scramble_images/row-2-col-3" name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
        <span class="checkmark"></span>
        <img src= scramble_images/row-2-col-3.jpg width="100" height="154" id = "scramble_images/row-2-col-3.jpg" name = "scramble_img">
      </label>
    </td>
    <td class="scramble-td" type= "text"></td>
    <td class="scramble-td" type= "button">
      <button onclick="swap('scramble_cb')">Swap</button>
      <br><br>
      <button onclick ="resetGame(9)">Reset</button>
    </td>
  </tr>

<tr class="scramble-row">
  <td class ="scramble-td">
    <label class="container">
      <input type="checkbox" id = "scramble_images/row-3-col-1" name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
      <span class="checkmark"></span>
      <img src= scramble_images/row-3-col-1.jpg width="100" height="154" id = "scramble_images/row-3-col-1.jpg" name = "scramble_img">
    </label>
  </td>
  <td class ="scramble-td">
    <label class="container">
      <input type="checkbox" id = "scramble_images/row-3-col-2"  name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
      <span class="checkmark"></span>
      <img src= scramble_images/row-3-col-2.jpg width="100" height="154" id = "scramble_images/row-3-col-2.jpg" name = "scramble_img">
    </label>
  </td>
  <td class ="scramble-td">
    <label class="container">
      <input type="checkbox" id = "scramble_images/row-3-col-3" name = "scramble_cb" onclick="limit_checkbox('scramble_cb',this,2)">
      <span class="checkmark"></span>
      <img src= scramble_images/row-3-col-3.jpg width="100" height="154" id = "scramble_images/row-3-col-3.jpg" name = "scramble_img">
    </label>
  </td>
  <td class="scramble-td" type= "text"></td>
  <td class="scramble-td" type= "button">
    <button id = "solutionbtn" onclick ="solution(9)">Solution</button>
  </td>
</tr>

</table>

<script src = "javascript/imageScramble.js"></script>

</body>
</html>