<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../treirad.css">
    <title>Tre I Rad</title>
</head>
<body>
    <h1 id="msg"></h1>
    <div class="container">
        <h1>Tre I Rad</h1>
        <div id="gameboard">
            <div class="box" id="0"></div>
            <div class="box" id="1"></div>
            <div class="box" id="2"></div>
            <div class="box" id="3"></div>
            <div class="box" id="4"></div>
            <div class="box" id="5"></div>
            <div class="box" id="6"></div>
            <div class="box" id="7"></div>
            <div class="box" id="8"></div>
        </div>
        <div class="modal">
            <div class="content">
                <h2 class="message">Grattis Spelare X</h2>
                <p class="message_small"></p>
                <button id="restartbtn">Starta om</button>
            </div>
        </div>
    </div>
    <script src="scriptMultiplayer.js"></script>
</body>
</html>
