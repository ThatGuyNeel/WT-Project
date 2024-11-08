<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in by verifying the session variable
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "DELETE FROM login WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Destroy all session data to log the user out
session_unset();
session_destroy();

// Redirect the user to the login page
header("Location: login.php");
exit();
?>
