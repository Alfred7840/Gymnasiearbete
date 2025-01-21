<?php

require_once 'sessioncheck.php';
require_once 'assets/config/db.php';
require_once 'assets/functions.php';
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="treirad.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

    <script defer src="script.js"></script>
    <title>Tre i rad</title>
</head>
<body>
    
    <p>Ändra uppgifter?: <a href="update.php">uppdatera</a></p>
    <p>Logga ut?: <a href="logout.php">logga ut</a></p>
    <h3> VÄLKOMMEN</h3>

    <div class="button-container">
        <!-- Button to play with Robot -->
       <a href="tirAi.php"><div id="play-robot" class="icon-button"><i class="fas fa-robot"></i> Spela mot robot</div> </a>

       <div class="button-container">
        <!-- Button to play with Robot -->
       <a href="tirLocal.php"><div id="play-player" class="icon-button"><i class="fas fa-user"></i> Spela lokalt</div> </a>


       <div class="button-container">
        <!-- Button to play with Robot -->
       <a href="test/tirMultiplayer.php"><div id="play-multiplayer" class="icon-button"><i class="fas fa-users"></i> Spela online</div> </a>
        </button>
    </div>
</body>
</html>
