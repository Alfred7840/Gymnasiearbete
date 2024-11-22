<?php

require_once 'config/db.php';
/* $hostname_forumtest = "localhost";
  $database_forumtest = "forum";
  $username_forumtest = "forum";
  $password_forumtest = "forum";

  //$forumtest = mysqli_connect($hostname_forumtest, $username_forumtest, $password_forumtest) or trigger_error(mysqli_error($forumtest),E_USER_ERROR);

  //$forum=null;

  try {
  $forum = new PDO("mysql:host=$hostname_forumtest;dbname=$database_forumtest", $username_forumtest, $password_forumtest);
  // set the PDO error mode to exception
  $forum->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }
 */

//if (!function_exists("GetSQLValueString")) {

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {

    switch ($theType) {
        case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "long":
        case "int":
            $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
        case "double":
            $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
        case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
    }
    return $theValue;
}

/*

function insertForumpost($username, $message) {
    $sql = "insert into forum (username, msg) values (:username, :message)";

    global $forum;

    $stmt = $forum->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':message', $message);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function getForumPosts() {
    $sql = "select * from forum order by tid     desc";

    global $forum;
    $stmt = $forum->prepare($sql);
    $stmt->execute();
    return $stmt;
}

*/

function validateUser ($tre_i_rad,$info) {
    $sql="SELECT * FROM user
       WHERE username=:username";

    $stmt = $tre_i_rad->prepare($sql);
    $stmt->bindValue(':username', $info['username']);
    $stmt->execute();

    if($stmt->rowCount() == 1){
        $pass = $stmt-> fetch(PDO::FETCH_ASSOC);
        
       if (password_verify($info ['password'], $pass['password'])) {
            //if($pass['password'] == $info ['password']){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}


function checkUsernameAndMail($tre_i_rad, $info) {
    $sql = "SELECT * FROM user WHERE username = :username or email = :mail";
    $stmt = $tre_i_rad->prepare($sql);
    $stmt->bindValue(':username', $info['username']);
    $stmt->bindValue(':mail', $info['email']);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
        return true;
    }
    else {
        return false;
    }
}


function insertNewUser($tre_i_rad, $info){
$sql="insert into user(username,email,password)
        values(:username,:mail, :password)";
    $stmt=$tre_i_rad->prepare($sql);
    $stmt->bindValue('username', $info['username']);
    $stmt->bindValue('mail', $info['email']);
    $stmt->bindValue('password', $info['password']);

    if($stmt->execute()){
    return true;
    }
    else{
        return false;
    }
}

function updateUser($tre_i_rad, $info) {
$sql ="UPDATE user SET email = :email,password = :password WHERE username = :username";
$stmt = $tre_i_rad->prepare($sql);
$stmt->bindValue(':username', $info['username']);
$stmt->bindValue('password', $info['password']);
$stmt->bindValue('email', $info['email']);

    $sql = "select * from user WHERE username=:username"; 

$stmt=$tre_i_rad->prepare($sql);
//$stmt->bindValue('username', $info['username']);
$records = getUserscore($tre_i_rad, $_POST);  // Pass the required arguments
if ($records) {
    $_SESSION['wins'] = $records['wins'];
    $_SESSION['losses'] = $records['losses'];
    $_SESSION['tie'] = $records['tie'];
    $_SESSION['played_games'] = $records['played_games'];
}
if($stmt-> execute()){
    return true;
    }
    else {
    return false;
    }
}


function getUserinfo($tre_i_rad, $info) {
    $sql = "select * from user WHERE username=:username"; 
print_r($info);
    $stmt=$tre_i_rad->prepare($sql);
    $stmt->bindValue('username', $info['username']);
    $records = getUserscore($tre_i_rad, $info);  // Pass the required arguments
    if ($records) {
        $_SESSION['wins'] = $records['wins'];
        $_SESSION['losses'] = $records['losses'];
        $_SESSION['tie'] = $records['tie'];
        $_SESSION['played_games'] = $records['played_games'];
    }

    // Redirect or display success message
    if ($stmt->execute()) {
        // Redirect or display success message
        header("Location: treirad.php");
        exit();
    } 
    
    // If needed, you can still return the prepared statement here (but this logic might need clarification)
    return $stmt;
}


function getUserscore($tre_i_rad, $info) {
    $sql = "SELECT * FROM user WHERE username=:username"; 
    $stmt = $tre_i_rad->prepare($sql);
    $stmt->bindValue(':username', $info['username']);
    $stmt->execute();

    // Fetch a single row as an associative array
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
function validateUsername($username) {
    // Allow only letters, numbers, and underscores
    return preg_match('/^[a-öA-Ö0-9_]+$/', $username);
}