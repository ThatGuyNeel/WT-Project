<?php
include 'db_connection.php';

// Check if product ID is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "DELETE FROM product WHERE id = ?";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "Product deleted successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request! No Product ID specified.";
}
?>
