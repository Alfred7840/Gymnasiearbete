<?php
//Infogar funktionalitet för inloggning
require_once 'login.php';
?>
<!DOCTYPE html>
<html lang="sv">
    <head>
        <meta charset="utf-8">
        <title>Formulär för inloggning</title>
         <link href="css/forum.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    //Kontrollerar om det finns felmeddelanden
    if(count($errors) > 0){
        //Skriver ut felmeddelanden
        echo'
        <ul>
        <li>'.implode('</li><li>',$errors).'</li>
        </ul>
        ';
    }
    ?>
    <p> Inget konto: <a href="signup.php">signup</a></p>
    <form action="index.php" method="post">
        <fieldset>
            <legend>Ange inloggningsuppgifter</legend>
            <ul>
                <li>
                    <label for="username">Användarnamn</label> 
                    <input name="username" type="text">
</li>
<li><br></li>
<li>
    <label for="password">Lösenord</label>
    <input name="password" type="password">
</li>
</ul>
</fieldset>
<input type="submit" name="submit" value="Skicka">
</form>
</body>
</html>