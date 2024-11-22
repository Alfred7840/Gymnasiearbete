<?php
$hostname = "localhost";
$database = "tre_i_rad";
$username = "tre_i_rad";
$password = "tre_i_rad";


try {
  $tre_i_rad = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $tre_i_rad->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully"; // denna rad kan tas bort om allt fungerar
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
