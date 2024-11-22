"use strict";

const ContainerEl = document.querySelector('.container');
let playerTxt = document.querySelector('.message');
let playerTxt2 = document.querySelector('.message_small');
let restartBtn = document.getElementById('restartbtn');
let boxes = document.querySelectorAll(".box");

const O_TXT = "O"
const X_TXT = "X"

let currentPlayer = X_TXT;
let spaces = Array(9).fill(null);
let clickAmount = 0;

let winnerIdicator = getComputedStyle(document.body).getPropertyValue(
    "--darkColor: ;"
);

//startar spelet
const startGame = () => {
    boxes.forEach((boxs) => boxs.addEventListener("click", boxClicked));
};

//box klickad
function boxClicked(e) {
    const id = e.target.id; 

    // kolla id
    if (!spaces[id]) {
        spaces[id] = currentPlayer;
        e.target.innerText = currentPlayer;
        clickAmount++;

        // kolla om någon har vunnit
        if (playerHasWon() !== false) {
            playerTxt.innerHTML = `<h2 class="message"> Grattis Spelare ${currentPlayer}</h2>`;
            playerTxt2.innerHTML = '<p class = "message_small"> Du har vunnit!</p>';
            winnerIdicator = playerHasWon();

            winnerIdicator.map(
                (box) => (boxes[box].style.backgroundColor = "#f4d03f")
            );

            ContainerEl.classList.add('success');
        }

        // Kontrollera om det är oavgjort (alla rutor fyllda, men ingen har vunnit)
        if (clickAmount === 9 && playerHasWon() === false) {
            playerTxt.innerHTML = "<h2 class='message'>Det blev oavgjort!</h2>";
            playerTxt2.innerHTML = '<p class = "message_small">Ingen vann</p>';
            ContainerEl.classList.add('success');
        }

        // Byt spelare
        currentPlayer = currentPlayer == X_TXT ? O_TXT : X_TXT;
    }
}

// vinst kombinationer
const winingCombination = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
]

// spelare vinner
function playerHasWon() {
    for (const condition of winingCombination) {
        let [a, b, c] = condition;

        if (spaces[a] && spaces[a] == spaces[b] && spaces[a] == spaces[c]) {
            return [a, b, c];
        }
    }
    return false;
}



//starta om spelet
restartBtn.addEventListener('click', restartGame);

function restartGame() {
    spaces.fill(null);
    clickAmount = 0; // Återställ klickräknaren

    boxes.forEach((box) => {
        box.innerHTML = "";
        box.style.backgroundColor = "";
    });

    playerTxt.innerHTML = "Tre I Rad";
    currentPlayer = X_TXT;
    ContainerEl.classList.remove("success");
}

// AJAX function to send the game result (win, loss, tie) to PHP
/*function updateGameStats(result) {
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    
    // Define the request type and URL
    xhr.open('POST', 'update_game_stats.php', true);
    
    // Set the request header for sending form data
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Define the data to send
    xhr.send('result=' + result);
    
    // Optional: Handle the response (e.g., display a success message or log)
    xhr.onload = function() {
        if (xhr.status == 200) {
            console.log('Game stats updated successfully');
        } else {
            console.error('Error updating game stats');
        }
    };
}
*/

startGame();