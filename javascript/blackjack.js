/* Global Variables */
var player;
var status;
var bankroll;
var betting;
var currentCardCell = "card-row-0-col-0";
var playedSplit = true;

// var count = 0;

//#region newGame
    
    function newGame() {
        disableAllButtons();
        updateGlobalVarsFromField();
        currentCardCell = "card-row-0-col-0";
        clearBoard();
        updateText();
        newGameStatus();
    }

    function resetGame() {
        disableAllButtons();
        status = "Place Your Bets!";
        bankroll = 2000;
        betting = 0;
        currentCardCell = "card-row-0-col-0";
        updateGlobalVars();
        clearBoard();
        updateText();
        newGameStatus();
    }

    function updateGlobalVars() {
        document.getElementById("status").innerHTML = "Status: " + status;
        document.getElementById("bankroll").innerHTML = "$" + bankroll;
        document.getElementById("betting").innerHTML = "$" + betting;
    }

    function updateGlobalVarsFromField() {
        status = document.getElementById("status").innerHTML.substring(8);
        bankroll = document.getElementById("bankroll").value;
        betting = document.getElementById("betting").value;
    }

    function nextGame() {
        betting = 0;
        status = "Place Your Bets!";
        currentCardCell = "card-row-0-col-0";
        disableAllButtons();
        clearBoard();
        updateText();
        newGameStatus();
    }
//#endregion

//#region Update Functions
function clearBoard() {
    var cards = document.getElementsByName("card");
    for(var i = 0; i < cards.length; i++) {
        cards[i].innerHTML = "";
        cards[i].style = "";
        cards[i].value = 0;
    }
    
    var a = document.getElementById("playersum");
    var b = document.getElementById("playersplit");
    var c = document.getElementById("dealersum");

    a.value = 0;
    b.value = 0;
    c.value = 0;

    a.innerHTML = a.value;
    b.innerHTML = b.value;
    c.innerHTML = c.value;
}

function updateText() { 
    document.getElementById("bankroll").value = bankroll;
    document.getElementById("betting").value = betting;
    document.getElementById("status").value = status;

    document.getElementById("status").innerHTML = "Status: " + status;
    document.getElementById("bankroll").innerHTML = "Bankroll: $" + bankroll;
    document.getElementById("betting").innerHTML = "Betting: $" + betting;
    
    

    /* Updates all sum of the row */
    var a = document.getElementById("playersum");
    var b = document.getElementById("playersplit");
    var c = document.getElementById("dealersum");

    a.innerHTML = a.value;
    b.innerHTML = b.value;
    c.innerHTML = c.value;
}

function updateSum(row) {
    var cardID = "card-row-" + row + "-col-0";
    var card = document.getElementById(cardID); //Card at the start of the row
    sum = getRowSumElement(cardID);
    sum.value = 0; //reset the sum of the row to 0

    /* computing sum of row */
    for(var i = 0; i < 11; i++) {
        if(card.value != undefined || card.value != 0) {
            sum.value += card.value;
            cardID = getNextCell(card.id);
            card = document.getElementById(cardID);
        }
    }
}
//#endregion

//#region Buttons
    function disableAllButtons() {
        var buttons = document.getElementsByName("button");
        for(var i = 0; i < buttons.length; i++)
            buttons[i].style="display: none";
    }

    function enableAllButtons() {
        var buttons = document.getElementsByName("button");
        for(var i = 0; i < buttons.length; i++)
            buttons[i].style="";
    }

    function enableBetting() {
        document.getElementById("1").style="";
        document.getElementById("10").style="";
        document.getElementById("20").style="";
        document.getElementById("100").style="";
        document.getElementById("500").style="";
        document.getElementById("reset").style="";
    }

    function newGameStatus() {
        enableBetting();
        document.getElementById("deal").style="";
        document.getElementById("resetgame").style="";
        document.getElementById("load").style="";
        document.getElementById("save").style="";
    }

    function enableContinue(bet) {
        var x = document.getElementById("continue");
        x.style = "";
        /* only if split is true... */
        if(getHandLength("card-row-1-col-1") && playedSplit) {
            betting = bet;
            bankroll = bankroll - betting;
            updateText();
        }
    }

    function disableContinue() {
        var x = document.getElementById("continue");
        x.style = "display: none";
    }

    function doubleDown() {
        bankroll -= betting;
        betting *= 2;
        updateText();
        dealCard();
        if(getHandLength("card-row-1-col-0") == 1)
            return splitPhase();
        dealersTurn();
        
    }

    /* check bankrupt -> newgame; nextgame otherwise */
    function cont() {
        if(checkBankrupt()) {
            return newGame();
        }

        var playerSplitRow = getRowSumElement("card-row-1-col-0");
        if(getHandLength("card-row-1-col-0") > 0 && playedSplit) {
            return dealersPhase(playerSplitRow);
        }
        return nextGame();
    }

    function betting1() {
        if(bankroll - 1 < 0) {
            alert("Not enough money!");
            return;
        }
        betting += 1;
        bankroll -= 1;
        updateText();
    }

    function betting10() {
        if(bankroll - 10 < 0) {
            alert("Not enough money!");
            return;
        }
        betting += 10;
        bankroll -= 10;
        updateText();
    }

    function betting20() {
        if(bankroll - 20 < 0) {
            alert("Not enough money!");
            return;
        }
        betting += 20;
        bankroll -= 20;
        updateText();
    }

    function betting100() {
        if(bankroll - 100 < 0) {
            alert("Not enough money!");
            return;
        }
        betting += 100;
        bankroll -= 100;
        updateText();
    }

    function betting500() {
        if(bankroll - 500 < 0) {
            alert("Not enough money!");
            return;
        }
        betting += 500;
        bankroll -= 500;
        updateText();
    }

    function reset() {
        bankroll += betting;
        betting = 0;
        updateText();
    }

    function enableSplit() {
        var x = document.getElementById("split");
        x.style="";
    }

    function disableSplit() {
        var x = document.getElementById("split");
        x.style="display:none";
    }
    //#region localsave and localstore
    function localSave() {
        localStorage.setItem("status",status);
        localStorage.setItem("bankroll",bankroll);
        localStorage.setItem("betting",betting);
    }

    function localStore() {
        status = localStorage['status'];
        bankroll = parseInt(localStorage['bankroll']);
        betting = parseInt(localStorage['betting']);
        updateText();
    }
    //#endregion

    //#region local file save and local file store
    function save() {
        var obj = {betting: betting, bankroll: bankroll, status: status};
        var myJSON = JSON.stringify(obj);
        download(myJSON, 'blackjack_game.json', 'text/plain');
    }

    function download(content, fileName, contentType) {
        var a = document.createElement("a");
        var file = new Blob([content], {type: contentType});
        a.href = URL.createObjectURL(file);
        a.download = fileName;
        a.click();
    }

    function load() {
        document.getElementById('file-input').click();
        readFile(this);
    }

    function readFile(e) {
        var file = e.target.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            var content = e.target.result;
            var obj = JSON.parse(content);
            status = obj['status'];
            bankroll = parseInt(obj['bankroll']);
            betting = parseInt(obj['betting']);
            updateText();
        };
        reader.readAsText(file);
        /* Resetting the file content to none */
        document.getElementById('file-input').value="";
    }
    //#endregion
//#endregion

//#region get and set methods
/* returns the sum of the hand based on the current row of the card */
function getSumOfHand(currentCard) {
    var sum = getRowSumElement(currentCard);
    return sum.value;
}

function getRowSumElement(currentCard) {
    var row = currentCard.split("-")[2];

    switch(row) {
        case "0":
            var sum = document.getElementById("playersum");
            break;
        case "1":
            var sum = document.getElementById("playersplit");
            break;
        case "2":
            var sum = document.getElementById("dealersum");
            break;
    }
    return sum;
}

/* returns the length of the hand */
function getHandLength(cardString) {
    var cardParts = cardString.split("-");
    var cardString = cardParts[0]+"-"+cardParts[1]+"-"+cardParts[2]+"-"+cardParts[3]+"-";
    var count = 0;
    var cardElement = document.getElementById(cardString+count);

    for(var i = 0; i < 11; i++) {
        if(cardElement.value > 0) {
            count++;
            cardElement = document.getElementById(cardString+count);
        }
    }
    return count;
}
//#endregion

//#region Generating Valid cards and getting next card
function blankCard(cardID) {
    var card = document.getElementById(cardID);
    var img = document.createElement('img');
    img.src = "images/cards/blackcard.png";
    img.style = "width: 100px; height: 152.82199710564399421128798842258px";
    card.appendChild(img);
}

function generateCard() {
    var cardInformation = [];

    /*Generate random card value and random suit */
    var cardValue = Math.random() * 12 + 1;
    cardValue = Math.round(cardValue);
    var suitValue = Math.random() * 3 + 1;
    suitValue = Math.round(suitValue);

    cardInformation[0] = cardValue; //stores initial card value
    
    /* Card Value Update */
    switch (cardValue) {
        case 1:
        cardValue = "A";
        break;
        case 11:
            cardValue = "J";
        break;
        case 12:
            cardValue = "Q";
        break;
        case 13:
            cardValue = "K";
        break;
    }

    /* Suit Value Update */
    switch (suitValue) {
        case 1:
            suitValue = "D";
            break;
        case 2:
            suitValue = "C";
            break;
        case 3:
            suitValue = "H";
            break;
        case 4:
            suitValue = "S";
            break;
    }
    var cardString = cardValue + suitValue; //card string

    /* Check for duplicate cards */
    if(checkDuplicateCards(cardString)) {
        return generateCard();
    }

    /* storing card string */
    cardInformation[1] = cardString;
    return cardInformation;
}

// function generateCard() { //test function
//     var card1 =  [8, "8♠"];
//     var card2 = [8, "8♠"];
//     var card3 = [10, "10♠"];
//     var card4 = [5, "5♠"];
//     var card5 = [1, "A♠"];
//     var card6 = [1, "A♠"];
//     var card7 = [1, "A♠"];
//     var card8 = [1, "A♠"];
//     var card9 = [1, "A♠"];

//     var array = [card1,card2,card3,card4, card5, card6, card7, card8, card9];
//     console.log("Testing: Generatecard");
//     return array[count++];
// }

function checkDuplicateCards(cardString) {
    var cards = document.getElementsByName("card");
    for(var i = 0; i < x.length; i++) {
        if(cards[i].childNodes[0].string == cardString) {
            console.log(cards[i].childNodes[0].string);
            return true;
        }
    }
    return false;
}

/* deals a card at the currentCardCell and updates the sum of the row Note: Does not generate next cell*/
function dealCard() {
    var currentCell = document.getElementById(currentCardCell);
    if(currentCell.childNodes[0] != null)
        currentCell.removeChild(currentCell.childNodes[0]);
    var cardArr = generateCard();
    currentCell.value = cardArr[0];
    currentCell.string = cardArr[1];
    var img = document.createElement('img');
    img.src = "images/cards/" + cardArr[1] + ".jpg";
    img.style = "width: 100px; height: 152.82199710564399421128798842258px";
    currentCell.appendChild(img);
    computeHand(currentCell);
    reComputeHand(currentCell);
    currentCell.style = "";
}

function computeHand(cardElement) {
    var cardValue = cardElement.value;
    /* compute row sum that the card is in */
    var row = cardElement.id.split("-")[2];
    var sum = getRowSumElement(cardElement.id);

    if(cardValue != undefined) {
        /* Deal with J,Q,K */
        if(cardValue == 11 || cardValue == 12 || cardValue == 13) {
            cardElement.value = 10;
        }
        /* Deal with the ace case */
        if(cardValue == 1 && 11 + sum.value <= 21) {
            cardElement.value = 11;
        }
    }
    updateSum(row);
    updateText();
}

/* recompute hand if sum of hand exceeds 21 -- fix ace values */
function reComputeHand(cardElement) {
    /* go through each card in the current row and recompute their values and then recompute the sum of the row again */
    var row = cardElement.id.split("-")[2];
    var cardID = "card-row-" + row + "-col-0";
    var card = document.getElementById(cardID); //Card at the start of the row

    sum = getRowSumElement(cardID);
    
    if(sum.value > 21) {
        for(var i = 0; i < 11; i++) {
            if(card.string != undefined && card.string != null) {
                var cardString = card.string.substring(0, 1);
                if(card.value != undefined || card.value != 0) {
                    if(cardString == "A") {
                        if(card.value == 11) {
                            card.value = 1;
                        }
                    }
                    cardID = getNextCell(card.id);
                    card = document.getElementById(cardID);
                }
            }
        }
    }
    updateSum(row);
    updateText();
}

function getNextCell(cardString) {
    var string = cardString.split("-");
    /* "card-row- -col-" */
    var part1 = cardString.substring(0, cardString.lastIndexOf("-")+1);;
    var new_column = parseInt(string[4])+1; //increment next column (next card)
    return part1 + new_column;
}
//#endregion

//#region check

/* disable buttons, checks if player is bankrupt, updates status if so */
function checkBankrupt() {
    disableAllButtons();
    if(bankroll <= 0) {
        status = "You have no money! Game Over";
        updateText();
        return true;
    }
    return false;
}
//#endregion

//#region dealingPhase
function dealingPhase() {
    if(betting > 0) {
        disableAllButtons();
        status = "Dealing Phase";
        clearBoard();
        updateText();
        dealing();
    } else {
        alert("Please bet something!");
    }
}
function dealing() {
    /* generate card and place in current cell */
    currentCell = document.getElementById(currentCardCell);

    if(currentCardCell == "card-row-2-col-0") {
        blankCard(currentCardCell);
    } else {
        dealCard();
    }
    sleep(800).then(() => {
        /* get the next cell and do dealing phase again */
        getNextDealingState();
        if(status != "Player's Turn")
            return dealing();
        
        return playersTurn();
    });
}

function getNextDealingState() {
    if(status == "Dealing Phase") {
        switch(currentCardCell) {
            case "card-row-0-col-0":
                /* Dealer gets card */
                currentCardCell = "card-row-2-col-0";
                break;
            case "card-row-2-col-0":
                /* Player gets card */
                currentCardCell = "card-row-0-col-1";
                break;
            case "card-row-0-col-1":
                /* Dealer gets card */
                currentCardCell = "card-row-2-col-1";
                break;
            default:
                /* Dealing Phase is over */
                status = "Player's Turn";
                currentCardCell = "card-row-0-col-2";
        }
    }
}
//#endregion

//#region Player's Turn
function playersTurn() {
    disableAllButtons();
    updateText();
    enablePlayerButtons();

    var x = document.getElementById(currentCardCell);
    
    /* check if the current hand has blackjack */
    if(getHandLength(currentCardCell) == 2  && getSumOfHand(currentCardCell) == 21) {
        disableAllButtons();
        status = "BlackJack!";
        updateText();
        sleep(1200).then(() => {
            return dealersTurn();
        });
    }

    /* checking for valid split */
    if(getHandLength("card-row-1-col-0") == 0) {
        x = document.getElementById("card-row-0-col-0");
        var array = [];
        if(getHandLength(x.id) == 2) {
            for(var i = 0; i < 2; i++) {
                array[i] = x;
                x = document.getElementById(getNextCell(x.id));
            }
            if(bankroll - betting > 0 && array[0].string.substring(0,1) == array[1].string.substring(0,1)) {
                enableSplit();
            }
        }
    }
}

function enablePlayerButtons() {
    document.getElementById("hit").style="";
    document.getElementById("stand").style="";
    document.getElementById("resetgame").style="";
    
    if(bankroll - betting >= 0)
        document.getElementById("dd").style="";
}

function hit() {
    disableAllButtons();
    /* Generate a card and place into cell -> Update the sum of the row */
    dealCard();
    /* Check if hand is 21 -> Dealer's Turn*/
    if(getSumOfHand(currentCardCell) == 21) {
        if(getHandLength("card-row-1-col-0") == 1)
            return splitPhase();
        return dealersTurn();
    }
    /* Check for bust -> Dealer's Turn */
    if(bust(currentCardCell)) {
        status = "Bust!";
        updateText();
        sleep(2000).then(() => {
            if(getHandLength("card-row-1-col-0") == 1)
                return splitPhase();
            return dealersTurn();
        });
    }
    /* Otherwise -> playersTurn() */
    else {
        currentCardCell = getNextCell(currentCardCell);
        playersTurn();
    }
}

function stand() {
    disableAllButtons();
    if(getHandLength("card-row-1-col-0") == 1)
        return splitPhase();
    return dealersTurn();
}

function bust(currentCard) {
    var sum = getRowSumElement(currentCard);
    if(sum.value > 21)
        return true;
    return false;
}

//#region Split Region

function split() {
    updateSplitText();
    currentCardCell = "card-row-0-col-1";
    disableSplit();
    dealCard();
    currentCardCell = getNextCell(currentCardCell);
}

function updateSplitText() {
    var x = document.getElementById("card-row-0-col-1");
    var y = document.getElementById("card-row-1-col-0");
    y.value = x.value;
    y.innerHTML = x.innerHTML;
    x.value = 0;
    x.innerHTML = "";
    updateText();
}

function splitPhase() {
    currentCardCell = "card-row-1-col-1";
    status = "Player's Split";
    updateText();
    dealCard();
    currentCardCell = getNextCell(currentCardCell);
    enablePlayerButtons();
}
//#endregion


//#endregion

//#region Dealer's Turn
function dealersTurn() {
    disableAllButtons();
    /* reveal black card */
    status = "Dealer's Turn";
    updateText();
    currentCardCell = "card-row-2-col-0";
    dealCard();

    currentCardCell = "card-row-2-col-2";
    var playersRow = getRowSumElement("card-row-0-col-0");
    dealersPhase(playersRow);
}

function dealersPhase(comparison) {
    switch(comparison.id) {
        case "playersum":
            var text = " against Player's Hand";
            var text2 = "Player ";
            break;
        case "playersplit":
            var text = " against Player's Split Hand";
            var text2 = "Player Split "
            playedSplit = false;
            break;
    }

    var dealersRow = getRowSumElement("card-row-2-col-0");

    sleep(1500).then(() => {
        var betting2 = betting;

        /* if dealer has 21 on TWO CARDS (blackjack) */
        if(getHandLength(currentCardCell) == 2 && dealersRow.value == 21) {
            status ="BlackJack!";
            updateText();
        }

        /* If the player busts, dealer wins automatically -> Update bet -- good*/
        if(comparison.value > 21) {
            status = "Dealer wins" + text + "!";
            betting = 0;
            updateText();
            sleep(1500).then(() => {
            checkBankrupt();
            enableContinue(betting2);
        });
            return;
        }

        /* If the player does not bust... <=16 keep hitting, stand otherwise */
        while(dealersRow.value <= 16 && comparison.value <= 21) {
            dealCard();
            currentCardCell = getNextCell(currentCardCell);
        }
        /* If dealer busts -> dealer loses */
        if(dealersRow.value > 21) {
            status = text2 + "wins!";
            bankroll += betting*2;
            betting = 0;
            updateText();
            enableContinue(betting2);
            return;
        }

        /* Dealer Stands -- Compare hands, whoever is larger (didn't bust), wins */
        if(comparison.value > dealersRow.value) {
            status = text2 + "wins!";
            bankroll += betting*2;
            betting = 0;
            updateText();
            enableContinue(betting2);
            return;

        } else if(comparison.value < dealersRow.value) {
            status = "Dealer wins" + text + "!";
            betting = 0;
            updateText();
            enableContinue(betting2);
            return;
        }

        /* Both hands are equal in value (or both players hae blackjack)-> push */
        if(comparison.value == dealersRow.value) {
            status="Push!";
            bankroll += betting;
            betting = 0;
            updateText();
            enableContinue(betting2);
            return;
        }
    });
}
//#endregion

function test() {
}


//#region sleeping
function sleep(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}
//#endregion