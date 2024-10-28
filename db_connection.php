<?php
// db_connection.php

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "store_database";

$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

// Check connection and handle errors
if (!$conn) {
    echo "Connection failed. Please check your database credentials or contact support.";
    return; 
}
?>
