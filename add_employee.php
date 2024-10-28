<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employees (name, position, salary) VALUES ('$name', '$position', $salary)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "New employee added successfully.";
    } else {
        echo "Error adding employee.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
    <h2>Add New Employee</h2>
    <form method="post" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Position:</label><br>
        <input type="text" name="position" required><br>
        <label>Salary:</label><br>
        <input type="number" name="salary" required><br>
        <input type="submit" value="Add Employee">
    </form>
    <br>
    <a href="employee_records.php">Back to Employee Records</a>
</body>
</html>

<?php
mysqli_close($conn);
?>
