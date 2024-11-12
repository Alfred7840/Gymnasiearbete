"use strict";

const ContainerEl = document.querySelector('.container');
let playerTxt = document.querySelector('.message');
let restartBtn = document.getElementById('restartbtn');
let boxes = document.querySelectorAll(".box");

const O_TXT = "O"
const X_TXT = "X"

let currentPlayer = X_TXT;
let spaces = Array(9).fill(null);

let winnerIdicator = getComputedStyle(document.body).getPropertyValue(
    "--darkColor: ;"
);

//startar spelet
const startGame = () => {
    boxes.forEach((boxs) => boxs.addEventListener("click", boxClicked));
};

//box klickad
function boxClicked(e){
    const id = e.target.id;


    // kolla id
    if(!spaces[id]){
        spaces[id] = currentPlayer;
        e.target.innerText = currentPlayer;

        // vinst logik
        if (playerHasWon() !== false){
            playerTxt.innerHTML = ` <h2 class="message"> Congratulation Player ${currentPlayer}</h2>`;
            winnerIdicator = playerHasWon();

            winnerIdicator.map(
                (box)=> (boxes[box].style.backgroundColor = "#f4d03f"),
        );

        ContainerEl.classList.add('success');
        }
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


startGame();



/*
function playerHasWon() {
    for(const condition of winingCombination) {
        let[a,b,c] = condition;

        if(spaces[a] && spaces[a] == spaces[b] && spaces[a] == spaces [c]){
         return [a,b,c] 
         
    }
    return false;
}

}

*/




//file:///home/alfred/Gymnasiearbete/index.html}