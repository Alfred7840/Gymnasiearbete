"use strict";

const ContainerEl = document.querySelector('.container');
let playerTxt = document.querySelector('.message');
let playerTxt2 = document.querySelector('.message_small');
let restartBtn = document.getElementById('restartbtn');
let boxes = document.querySelectorAll(".box");
let isProcessing = false; // 


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

    if (isProcessing || spaces[id]) {
        return; // Prevent further clicks if AI is processing or spot is taken
    }

    spaces[id] = currentPlayer;
    e.target.innerText = currentPlayer;
    clickAmount++;

    if (playerHasWon() !== false) {
        playerTxt.innerHTML = `<h2 class="message"> Grattis Spelare ${currentPlayer}!</h2>`;
        winnerIdicator = playerHasWon();
        winnerIdicator.map(box => (boxes[box].style.backgroundColor = "#f4d03f"));
        ContainerEl.classList.add('success');
        return;
    }

    if (clickAmount === 9 && playerHasWon() === false) {
        playerTxt.innerHTML = "<h2 class='message'>Det blev oavgjort!</h2>";
        ContainerEl.classList.add('success');
        return;
    }

    currentPlayer = currentPlayer == X_TXT ? O_TXT : X_TXT;

    // Disable further clicks and let AI make its move
    if (currentPlayer === O_TXT) {
        isProcessing = true; // Prevent further clicks
        setTimeout(() => {
            aiMakeMove();
            isProcessing = false; // Re-enable clicks after AI's move
        }, 500); // Delay for a better user experience
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


function aiMakeMove() {
    // Find all available spots
    const availableSpots = spaces
        .map((space, index) => (space === null ? index : null))
        .filter(index => index !== null);

    // Pick a random spot
    const randomIndex = Math.floor(Math.random() * availableSpots.length);
    const chosenSpot = availableSpots[randomIndex];

    // Make the move
    spaces[chosenSpot] = currentPlayer;
    boxes[chosenSpot].innerText = currentPlayer;

    // Check if AI wins
    if (playerHasWon() !== false) {
        playerTxt.innerHTML = `<h2 class="message"> AI (${currentPlayer}) har vunnit!</h2>`;
        winnerIdicator = playerHasWon();
        winnerIdicator.map(box => (boxes[box].style.backgroundColor = "#f4d03f"));
        ContainerEl.classList.add('success');
    } else if (clickAmount === 9 && playerHasWon() === false) {
        playerTxt.innerHTML = "<h2 class='message'>Det blev oavgjort!</h2>";
        ContainerEl.classList.add('success');
    }

    // Switch to player
    currentPlayer = currentPlayer == X_TXT ? O_TXT : X_TXT;
}


startGame();