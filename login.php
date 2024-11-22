<?php
require_once 'assets/config/db.php';
require_once 'assets/functions.php';
//Initierar sessionhantering
session_start();
$errors = array();
//Kontrollerar om logga in-knappen har tryckts
if (isset($_POST['submit'])){
    //Deklarerar en vektor för att spara felmeddelanden
    //Kontrollerar om fälten användarnamn och lösenord är tomma
    if (empty($_POST['username'])||
    empty($_POST['password']))
    {
        //Skapar ett felmeddelande
        $errors[] = 'Fyll i fälten för användarnamn och lösenord';
    }

   if(!validateUser($tre_i_rad, $_POST)){
$errors[] = 'Kontrollera användarnamn och lösenord';

   }
    //Kontrollerar om felmeddelandet har genererats
    if(count($errors) == 0){
        //Skapar en sesssionsvariabel med id-nummer 1
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        //Skickar en användare till skyddat innehåll
                   // Fetch user score from the database
                   $records = getUserscore($tre_i_rad, $_POST);  // Pass the required arguments
                   if ($records) {
                       $_SESSION['wins'] = $records['wins'];
                       $_SESSION['losses'] = $records['losses'];
                       $_SESSION['tie'] = $records['tie'];
                       $_SESSION['played_games'] = $records['played_games'];
                   }
        header('Location: treirad.php');
    }
}
?>