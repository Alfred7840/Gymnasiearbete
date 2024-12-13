<?php

require_once 'sessioncheck.php';
require_once 'assets/config/db.php';
require_once 'assets/functions.php';



if (isset($_POST["submit"])) {
    $_SESSION['password'] = $_POST['password'];
    $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $_POST['password'] = $hashedPassword;
    updateUser($tre_i_rad, $_POST);


}


$records = getUserinfo($tre_i_rad, $_SESSION);


if($records->rowCount() >0){
$row_Recordset1=$records->fetch(PDO::FETCH_ASSOC);    
}
?>

<!DOCTYPE html>
<html lang ="sv">
    <head>

<link href="css/forum.css" rel="stylesheet" type="text/css">
</head>
<body>

<h1> Uppdatera din information</h1>

<a href="logout.php">Logga ut</a> <br> <br>
<a href="treirad.php">Tillbaka</a> <br> <br>
<form action="update.php" method="post">
<input class = "box" type = "email" name="email" id ="email" placeholder = "email" required maxlenth = "25"minlength="3" value = "<?php echo $row_Recordset1['email']; ?>"><br>
<input class = "box" type ="password" name = "password" id = "password"placeholder = "Password" required minlength = "3" value = "<?php echo $_SESSION['password']; ?>"><br>
<input class = "btn" type ="submit" name ="submit" value ="Bekräfta"><br>
<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
</form>
</body>
</html>