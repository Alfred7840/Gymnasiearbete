<?php
require_once 'assets/config/db.php';
require_once 'assets/functions.php';

$error = false;
if (isset($_POST['submit'])) {
    // Validate username and email
    if (!validateUsername($_POST['username'])) {
        $error = true;
    } elseif (checkUsernameAndMail($tre_i_rad, $_POST)) {
        $error = true;
    } else {
        // Hash the password
        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $_POST['password'] = $hashedPassword;

        // Insert the new user into the database
        if (insertNewUser($tre_i_rad, info: $_POST)) {
            // Start the session
            session_start();
            $_SESSION['username'] = $_POST['username'];

            // Fetch user score from the database
            $records = getUserscore($tre_i_rad, $_POST);  // Pass the required arguments
            if ($records) {
                $_SESSION['wins'] = $records['wins'];
                $_SESSION['losses'] = $records['losses'];
                $_SESSION['tie'] = $records['tie'];
                $_SESSION['played_games'] = $records['played_games'];
            }

            // Redirect or display success message
            header("Location: treirad.php");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<link rel="stylesheet" href="signupstyle.css">
<html lang="sv"> 
<head> 
<link href="css/forum.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Formulär för signup</title>
<p> Har du konto?: <a href="index.php">Logga in</a></p>
</head>
<body>
    <?php
if($error){
    echo "<h1> Kontrollera användarnamnet och mail, inga special tecken tillåts.</h1>";
}
    ?>
<h1>Registrera Dig</h1>
<form action="signup.php" method="post">
  <fieldset class="registrera">
    <legend>Fyll i här nedan:</legend>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>

</body>
</html>