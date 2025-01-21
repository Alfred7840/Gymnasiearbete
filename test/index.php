<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "../treirad.css">
    <title>Websocket Client</title>
</head>
<body>

<script>
console.log('APA');
const socket = new WebSocket('ws://alfred-thinkcentre-m900.adm.huddinge.se:3000');

socket.addEventListener('message', (event) => {
    document.getElementById('msg').innerHTML=event.data;
    console.log('Recieved: ', event.data);

})

socket.addEventListener('close', (event) => {
    console.log('Connection closed.');
})

function sendMsg(text){
    var username ="APA";// document.getElementById('username').value;
    var text = document.getElementById('message').value;
    socket.send(username + " sent: " + text);

}

</script>
<form action = "" method = "post">
    <input type = "text" id = "username">
    <input type = "text" id = "message">
<input type = "button" value = "send" onclick = "sendMsg()">
</form>
<h1 id = "msg"></h1>
<div class ="container">
<h1> Tre I Rad</h1>
<div id="gameboard">
<div class="box" id ="0" onclick = "sendMsg('0')"></div>
<div class="box" id ="2" onclick = "sendMsg('1')"></div>
<div class="box" id ="3" onclick = "sendMsg('2')"></div>
<div class="box" id ="1" onclick = "sendMsg('3')"></div>
<div class="box" id ="4" onclick = "sendMsg('4')"></div>
<div class="box" id ="5" onclick = "sendMsg('5')"></div>
<div class="box" id ="6" onclick = "sendMsg('6')"></div>
<div class="box" id ="7" onclick = "sendMsg('7')"></div>
<div class="box" id ="8" onclick = "sendMsg('8')"></div>

<div class="modal">
 <div class="content">
<h2 class ="message">Grattis Spelare X </h2>
<p class = "message_small"></p>
<button id="restartbtn"> Starta om</button>
</div>
</div>
</div>
    </div>
<script src="../scriptLocal.js"></script>


</body>

</html>