<!DOCTYPE html>
<lang ="en">
<head>
<link rel = "stylesheet" href = "treiradMultiplayer.css">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content ="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Document </title>
</head>
<body>   
<h2> Tre i rad </h2>

<div>

<p id="userCont">You : <span id ="user"></span> </p>
<p id="oppNameCont">Opponent : <span id ="oppName"></span> </p>

</div>
<br>

<p id="valueCont">You are playing as <span id="value"></span></p>
<br>
<p id ="whosTurn">X's Turn</p>

<div>

<p id="enterName"> Enter your name :      </p>
<input type="text" placeholder="Name" id="name" autocomplete="off">
</div>

<button id="find">Search for a player</button>
<img src="loading.gif" id="loading" alt="">

<div id="bigCont"> 

   <div id="cont"> 
    
   <button id="btn1" class="btn"></button>
   <button id="btn2" class="btn"></button>
   <button id="btn3" class="btn"></button>
   <button id="btn4" class="btn"></button>
   <button id="btn5" class="btn"></button>
   <button id="btn6" class="btn"></button>
   <button id="btn7" class="btn"></button>
   <button id="btn8" class="btn"></button>
   <button id="btn9" class="btn"></button>

</div>
</div>

</body>

<script>   
document.getElementById("loading").style.display="none"
document.getElementById("bigCont").style.display="none"
document.getElementById("userCont").style.display="none"
document.getElementById("oppNameCont").style.display="none"
document.getElementById("valueCont").style.display="none"
document.getElementById("whosTurn").style.display="none"

const socket=io();

let name;
document.getElementById("find").addEventListener("click", function(){
 name=document.getElementById("name").value

 document.getElementById("user").InnerText=name
 if(name===null || name===''){
   alert("enter a name")
 } 
 //socketio 
else{

    socket.emit("find",{name:name})

    document.getElementById("loading").display="block"
    document.getElementById("find").disabled=true

}


});

socket.on("find",(e)=>{
let allPlayersArray=e.allPlayers
console.log(allPlayersArray)

document.getElementById("userCont").style.display="block"
document.getElementById("oppNameCont").style.display="block"
document.getElementById("valueCont").style.display="block"
document.getElementById("loading").style.display="none"
document.getElementById("name").style.display="none"
document.getElementById("find").style.display="none"
document.getElementById("enterName").style.display="none"
document.getElementById("bigcont").style.display="block"
document.getElementById("whosTurn").style.display="block"
document.getElementById("whosTurn").style.display="X's Turn"

let oppName
let value

const foundObj=allPlayersArray.find(obj=>obj.p1.p1name==`${name}` || obj.p2.p2name==`${name}`)
foundObj.p1.p1name==`${name}` ? oppname=foundObj.p2.p2name : oppname=foundObj.p1.p1name
foundObj.p1.p1name==`${name}` ? value=foundObj.p2.p2value : value=foundObj.p1.p1value

document.getElementById("oppName").innerText=oppName
document.getElementById("value").innerText=value

})

</script>
<script src="script"></script>
</body>
</html>