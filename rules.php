<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlackJack</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
     h1{
        color: rgb(207, 75, 75);
        text-align: left;
        padding: 10px;
        text-indent: 100px;
        font-size: 20px;
        margin: auto;
     }
     p[class="rules"] {
        color: darkcyan;
        text-align: center;
        text-indent: 30px;
        max-width: 1250px;
        padding: 12px;
        margin: auto;
     }
  </style>
</head>
<body>
  <?php
      include_once 'includes/navbar.php';
  ?>
  <h1 class = "h1-center">Goal</h1>
  <p class="rules"> Beat the dealer by getting as close to 21 with cards you get dealt without going over. Amount of players: 2-7 players </p>
  <h1>Card Values</h1>
  <p class="rules"> Ace card can be of value 1 or 11, whichever plays in player's favor.
  Cards 2-10 are face value.
  Cards Jack, Queen, and King are of value 10.</p>
  <h1>Betting</h1>
  <p class="rules">Players place bets before cards are dealt. You lose your bets if you bust and collect the amount you bet if you win.</p>
  <h1>Dealing</h1>
  <p class="rules">Dealer gives players in clockwise rotation a card facing up, then one facing up for themselves last. 
    Second round of cards is dealt to all players but the one dealer gets is faced down. 
  <h1>Playing your hand</h1>
    <p class="rules">At this point, you can choose to <b>HIT</b> to attempt to get your hand closer to 21, or <b>STAND</b> to play your hand. 
    Playing your hand means the dealer will then reveal their second card and compare values with all players.
    However, the dealer must hit if their hand is lower than 16, and they must stand when they reach 17.
    Player <b>WINS</b> if their hand is closer to 21 than the dealer's hand. Player loses if their hand exceeds 21, which is a <b>BUST</b>. If a dealer busts,
  all players who hasn't bust collect their winnings.</p>
  <h1>Your moves</h1>
  <p class="rules"> You can <b>SPLIT</b> your cards for a chance to double your chance of winning. You can only split if your first 2 cards are a pair.
    You can <b>DOUBLE DOWN</b> to double your bet after receiving your initial cards, in return you get dealt one additional card. This is a strategy for winning if your hand is a 10 or 11.</p>
  <h1>Special Cases</h1>
  <p class="rules">A <em>natural</em> or a <em>blackjack</em> is when a player's first two cards are an ace and a value 10 card, adding up to 21.
    Dealer pays you 3 to 2 of your bet if you have a natural and they don't.
    <b>PUSH</b> is when you and the dealer's hand match. Nobody wins.</p>
</body>
</html>