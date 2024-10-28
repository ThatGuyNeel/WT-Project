<?php
// initialize_database.php

$servername = "localhost";
$db_username = "root";
$db_password = "";

// Create connection
$conn = mysqli_connect($servername, $db_username, $db_password);

if (!$conn) {
    echo "Failed to connect to the server.";
    return; 
}

// Create the database if it doesn’t already exist
$sql = "CREATE DATABASE IF NOT EXISTS store_database";
$db_created = mysqli_query($conn, $sql);

if (!$db_created) {
    echo "Error occurred while creating the database.";
    return; 
}

// Select the newly created database
mysqli_select_db($conn, "store_database");

// Create the `employees` table if it doesn’t already exist
$table = "CREATE TABLE IF NOT EXISTS employees (
    id INT INT(3) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    salary INT(10) NOT NULL
)";

$table_created = mysqli_query($conn, $table);

if (!$table_created) {
    echo "Error occurred while creating the employees table.";
    return; 
}

echo "Database and table setup completed successfully.";


mysqli_close($conn);
?>
