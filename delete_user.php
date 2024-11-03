<?php
// Check if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection
    include 'db_connection.php';
    // Delete user data
    $sql = "DELETE FROM users WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request!";
}
?>
