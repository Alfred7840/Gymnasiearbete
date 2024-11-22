<?php
// Include the database connection file
require_once 'config/db.php';

// Check if the result is passed via POST
if (isset($_POST['result']) && isset($_SESSION['username'])) {
    $result = $_POST['result']; // Get the result ('win', 'loss', 'tie')
    $username = $_SESSION['username']; // Assuming username is stored in session after login

    // Prepare the SQL query to update the user's stats
    switch ($result) {
        case 'win':
            $sql = "UPDATE user SET wins = wins + 1, played_games = played_games + 1 WHERE username = :username";
            break;
        case 'loss':
            $sql = "UPDATE user SET losses = losses + 1, played_games = played_games + 1 WHERE username = :username";
            break;
        case 'tie':
            $sql = "UPDATE user SET tie = tie + 1, played_games = played_games + 1 WHERE username = :username";
            break;
        default:
            // If the result is not valid, exit the script
            exit('Invalid result');
    }

    // Prepare the statement
    $stmt = $tre_i_rad->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    // Return a success response
    echo 'Game stats updated successfully';
} else {
    // If no result is passed or no session username is found
    exit('Missing game result or user session');
}
?>
