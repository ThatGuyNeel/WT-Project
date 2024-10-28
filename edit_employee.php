<?php
include 'db_connection.php';


if ($_GET['id'] != "") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $employee = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "UPDATE employees SET name='$name', position='$position', salary=$salary WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Employee updated successfully.";
    } else {
        echo "Error updating employee.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>
<body>
    <h2>Edit Employee</h2>
    <form method="post" action="">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $employee['name']; ?>" required><br>
        <label>Position:</label><br>
        <input type="text" name="position" value="<?php echo $employee['position']; ?>" required><br>
        <label>Salary:</label><br>
        <input type="number" name="salary" value="<?php echo $employee['salary']; ?>" required><br>
        <input type="submit" value="Update Employee">
    </form>
    <br>
    <a href="employee_records.php">Back to Employee Records</a>
</body>
</html>

<?php

mysqli_close($conn);
?>
