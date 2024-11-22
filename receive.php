<!DOCTYPE html>
<html lang ="sv">
    <head>
<title> receive.php </title>
<meta charset ="utf-8"> 
</head>
<body>
<?php
//Kontrollerar om GET-variabler existerar
if (isset($_GET['nickname']) && isset($_GET['phone'])) {
    echo '<p>' . $_GET['nickname'] . '</p>
          <p>' . $_GET['phone'] . '</p>';
}
if (isset($_GET['nickname']) && isset($_GET['phone'])) {
    echo '<p>' . $_GET['nickname'] . '</p>
          <p>' . $_GET['phone'] . '</p>';
}
?>
</body>
</html>