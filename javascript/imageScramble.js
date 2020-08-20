var turn = 0;
var status;
var solution_status = new Boolean(0);
var size;

function limit_checkbox(name,obj,max) {
   var count=0;
   var x=document.getElementsByName(name);
   for (var i=0; i < x.length; i++)
      {
      if(x[i].checked)
	     {
         count = count + 1;
		 }
	  }	
   if (count > max)
	  {
	  obj.checked = false;
      }
}

function swap(name) {
    /* Find all elements that are checkboxes */
    var x = document.getElementsByName(name);
    var y = [];
    for(var i = 0; i < x.length; i++) {
        if(x[i].checked) {
            y.push(x[i]);
        }
    }

    /* parse img id for checkbox */
    var textA = y[0].id;
    var textB = y[1].id;

     /* queries for corresponding img that the cb controls */
     var cellA = document.querySelector("[src='" + textA + ".jpg']");

     var cellB = document.querySelector("[src='" + textB + ".jpg']");
 
     /* swap img sources for respective cells */
     cellA.src = textB + ".jpg";
     cellB.src = textA + ".jpg";

     /* updates cb in relation to the img it controls */
     y[0].id = textB;
     y[1].id = textA;
 
     /*unchecks checkboxes*/
     y[0].checked = false;
     y[1].checked = false;

     /* updating turn */
     incrementTurn();

     if(updateStatus()) {
        setTimeout(function() {
            alert("Congratulations! You have completed the puzzle in " + window.turn + " turns");
        }, 0);
     }
}

function incrementTurn() {
    turn += 1;
    document.getElementById("turn_status").innerHTML = "Turn: " + turn;
}

function updateStatus() {
    if(validatePuzzle().valueOf() == 1) {
        document.getElementById("status").innerHTML = "Status: " + "Complete";
        disableCB();
        return true;
    }
    return false;
}

function resetStatus() {
    document.getElementById("status").innerHTML = "Status: " + "Incomplete";
}

function validatePuzzle() {
    var x = document.getElementsByName("scramble_img");
    for(var i = 0; i < x.length; i++) {
        if(!x[i].src.includes(x[i].id)) {
            return false;
        }
    }
    return true;
}

function enableCB() {
    var y = document.getElementsByName("scramble_cb");

    for(var i = 0; i < y.length; i++) {
        y[i].onclick = function() { limit_checkbox('scramble_cb',this,2) };
    }
}

function disableCB() {
    var y = document.getElementsByName("scramble_cb");

    for(var i = 0; i < y.length; i++) {
        y[i].onclick = function() { limit_checkbox('scramble_cb',this,0) };
    }
}

function resetGame(s) {
    size = s;
    resetCheckBoxes();
    enableCB();
    turn = -1;
    incrementTurn();
    resetStatus();
    var x = document.getElementsByName("scramble_cb");

    var y = document.getElementsByName("scramble_img");

    for(var i = 0; i < size; i++) {
        /* generate random number */
            var rand = i;
            rand = Math.random() * size;
            rand = Math.round(rand);

        swap_img(x[i], x[rand]);
        /* update node list */
        temp = x[i];
        x[i] = x[rand];
        x[rand] = temp;
    }
}



function swap_img(cellA, cellB) {
    var cellC = document.querySelector("[src='" + cellA.id + ".jpg']");
    var cellD = document.querySelector("[src='" + cellB.id + ".jpg']");

    var temp = cellA.id;
    cellA.id = cellB.id;
    cellB.id = temp;

    cellC.src = cellA.id + ".jpg";
    cellD.src = cellB.id + ".jpg";
    
}

function solution() {
    resetCheckBoxes();
    disableCB();
    turn = -1;
    incrementTurn();
    var x = document.getElementsByName("scramble_img");

    var y = document.getElementsByName("scramble_cb");
    

    for(var i = 0; i < size; i++) {
        x[i].src = x[i].id;
        
        y[i].id = x[i].id.substr(0, x[i].id.length - 4);
        console.log(y[i]);
    }
    updateStatus();
}

function resetCheckBoxes() {
    var x = document.getElementsByName("scramble_cb");
    for(var i = 0; i < size; i++) {
        x[i].checked = false;
    }
}