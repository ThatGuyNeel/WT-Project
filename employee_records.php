<?php
// employee_records.php
include 'db_connection.php';

if (!$conn) {
    echo "Could not connect to the database.";
    exit;
}

// Retrieve all employee records
$sql = "SELECT id, name, position, salary FROM employees";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "An error occurred while retrieving the records. Please try again.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Records</title>
</head>
<body>
    <h2>Employee Records</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['position']}</td>
                        <td>{$row['salary']}</td>
                        <td>
                            <a href='edit_employee.php?id={$row['id']}'>Edit</a> |
                            <a href='delete_employee.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="add_employee.php">Add New Employee</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
