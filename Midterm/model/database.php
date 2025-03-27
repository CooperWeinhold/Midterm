<?php
// database.php - Connects to the zippyusedautos database

$dsn = 'mysql:host=localhost;dbname=zippyusedautos';
$username = 'root';      
$password = '';          

try {
    $db = new PDO($dsn, $username, $password);
    // Enable error reporting
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../view/db_error.php'); 
    exit();
}
?>
