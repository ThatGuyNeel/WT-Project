<?php
include 'header.php';
// Connect to the database
include 'db_connection.php';

// Display Login Records Table
echo "<h2>Login Records</h2>";
$result = mysqli_query($conn, "SELECT * FROM login");
echo "<table border='1'>
        <tr><th>ID</th><th>Username</th><th>Date Logged In</th><th>Actions</th></tr>";
while ($row = mysqli_fetch_row($result)) {
    echo "<tr>
            <td>{$row[0]}</td>
            <td>{$row[1]}</td>
            <td>{$row[2]}</td>
            <td>
                <a href='edit_login.php?id={$row[0]}'>Edit</a> |
                <a href='delete_login.php?id={$row[0]}'>Delete</a>
            </td>
          </tr>";
}
echo "</table><a href='add_login.php'>Add New Login</a>";

// Display Signup Records Table
echo "<h2>Signup Records</h2>";
$result = mysqli_query($conn, "SELECT * FROM users");
echo "<table border='1'>
        <tr><th>Employee ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
while ($row = mysqli_fetch_row($result)) {
    echo "<tr>
            <td>{$row[0]}</td>
            <td>{$row[1]} {$row[2]}</td>
            <td>{$row[3]}</td>
            <td>
                <a href='edit_user.php?id={$row[0]}'>Edit</a> |
                <a href='delete_user.php?id={$row[0]}'>Delete</a>
            </td>
          </tr>";
}
echo "</table><a href='add_user.php'>Add New User</a>";

// Display Product Records Table
echo "<h2>Product Records</h2>";
$result = mysqli_query($conn, "SELECT * FROM products");
echo "<table border='1'>
        <tr><th>Product ID</th><th>Product Name</th><th>Supplier</th><th>Actions</th></tr>";
while ($row = mysqli_fetch_row($result)) {
    echo "<tr>
            <td>{$row[0]}</td>
            <td>{$row[1]}</td>
            <td>{$row[2]}</td>
            <td>
                <a href='edit_product.php?id={$row[0]}'>Edit</a> |
                <a href='delete_product.php?id={$row[0]}'>Delete</a>
            </td>
          </tr>";
}
echo "</table><a href='add_product.php'>Add New Product</a>";

// Close connection
mysqli_close($conn);
?>
