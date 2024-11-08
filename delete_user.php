<?php
if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    // Database connection
    include 'db_connection.php';
    // Delete user data
    $sql = "DELETE FROM user WHERE employee_id='$employee_id'";

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
