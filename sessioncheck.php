<?php
//Initierar sessionshantering
session_start();
//Kontrollerar om sessionsvariabel existerar
if(!isset($_SESSION['username'])){
    echo "FAAAAAAAAAAAAAAAAN";
    //Skicka användaren till startsidan
  //  header('Location: index.php');
}
//print_r($_SESSION);
?>