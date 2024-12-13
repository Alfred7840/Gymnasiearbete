<?php

require_once 'sessioncheck.php';
require_once 'assets/config/db.php';
require_once 'assets/functions.php';
?>

<!DOCTYPE html>
<html lang ="sv">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content ="width=device-width, initial-scale=1.0"/>
        <link rel = "stylesheet" href = "treirad.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

        <script defer src="scriptAI.js"></script>
        <title> Tre i rad </title>
        </head>
     

            <p> Ändra uppgifter?: <a href="update.php">uppdatera</a></p>
            <p> Logga ut?: <a href="logout.php">logga ut</a></p>
    <div class ="container">
<h1> Tre I Rad</h1>
<div id="gameboard">
<div class="box" id ="0"></div>
<div class="box" id ="1"></div>
<div class="box" id ="2"></div>
<div class="box" id ="3"></div>
<div class="box" id ="4"></div>
<div class="box" id ="5"></div>
<div class="box" id ="6"></div>
<div class="box" id ="7"></div>
<div class="box" id ="8"></div>

<div class="modal">
 <div class="content">
<h2 class ="message">Grattis Spelare X </h2>
<p class = "message_small"></p>
<button id="restartbtn"> Starta om</button>
</div>
</div>
</div>
    </div>
        </body>
        </html>