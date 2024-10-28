<?php
// delete_employee.php
include 'db_connection.php';

// Check if 'id' is present in the URL
if ($_GET['id'] != "") {
    $id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Employee deleted successfully.";
    } else {
        echo "Error deleting employee.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Employee</title>
</head>
<body>
    <h2>Employee Deleted</h2>
    <p>The employee record has been deleted.</p>
    <a href="employee_records.php">Back to Employee Records</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
