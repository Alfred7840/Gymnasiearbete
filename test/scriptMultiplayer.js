"use strict";

const ContainerEl = document.querySelector('.container');
let playerTxt = document.querySelector('.message');
let playerTxt2 = document.querySelector('.message_small');
let restartBtn = document.getElementById('restartbtn');
let boxes = document.querySelectorAll(".box");

const O_TXT = "O";
const X_TXT = "X";

let currentPlayer = X_TXT;
let spaces = Array(9).fill(null);
let clickAmount = 0;

let winnerIdicator = getComputedStyle(document.body).getPropertyValue("--darkColor: ;");

// WebSocket-anslutning
const ws = new WebSocket('ws://alfred-thinkcentre-m900.adm.huddinge.se:3000');

// Hantera WebSocket-anslutning
ws.onopen = () => {
    console.log('Connected to WebSocket server');
};

ws.onmessage = (event) => {
    const data = JSON.parse(event.data);

    if (data.type === 'move') {
        const { player, boxId } = data;

        // Uppdatera rutan
        spaces[boxId] = player;
        boxes[boxId].innerText = player;

        // Byt till nästa spelare
        currentPlayer = player === X_TXT ? O_TXT : X_TXT;

        // Kontrollera om spelet är över
        checkWinner();
    }
};

// Funktion för att skicka spelardata till servern
function sendMsg(id) {
    const message = JSON.stringify({ type: 'move', player: currentPlayer, boxId: id });
    ws.send(message);
}

// Starta spelet
const startGame = () => {
    boxes.forEach((box) => box.addEventListener("click", boxClicked));
};

// Hantera klick
function boxClicked(e) {
    const id = e.target.id;

    if (!spaces[id]) {
        spaces[id] = currentPlayer;
        e.target.innerText = currentPlayer;
        clickAmount++;

        sendMsg(id); // Skicka data till servern
        checkWinner();
    }
}

// Kontrollera vinst
function checkWinner() {
    if (playerHasWon() !== false) {
        playerTxt.innerHTML = `<h2 class="message"> Grattis Spelare ${currentPlayer}</h2>`;
        playerTxt2.innerHTML = '<p class = "message_small"> Du har vunnit!</p>';
        winnerIdicator = playerHasWon();

        winnerIdicator.map(
            (box) => (boxes[box].style.backgroundColor = "#f4d03f")
        );

        ContainerEl.classList.add('success');
    }

    // Kontrollera oavgjort
    if (clickAmount === 9 && playerHasWon() === false) {
        playerTxt.innerHTML = "<h2 class='message'>Det blev oavgjort!</h2>";
        playerTxt2.innerHTML = '<p class = "message_small">Ingen vann</p>';
        ContainerEl.classList.add('success');
    }

    // Byt spelare
    currentPlayer = currentPlayer === X_TXT ? O_TXT : X_TXT;
}

// Vinstkombinationer
const winingCombination = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
];

// Kontrollera om spelaren vunnit
function playerHasWon() {
    for (const condition of winingCombination) {
        let [a, b, c] = condition;

        if (spaces[a] && spaces[a] === spaces[b] && spaces[a] === spaces[c]) {
            return [a, b, c];
        }
    }
    return false;
}

// Starta om spelet
restartBtn.addEventListener('click', restartGame);

function restartGame() {
    spaces.fill(null);
    clickAmount = 0;

    boxes.forEach((box) => {
        box.innerHTML = "";
        box.style.backgroundColor = "";
    });

    playerTxt.innerHTML = "Tre I Rad";
    currentPlayer = X_TXT;
    ContainerEl.classList.remove("success");
}

startGame();
