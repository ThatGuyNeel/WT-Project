<?php
include 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	include 'login.php';
    $sql = "INSERT INTO Login (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "New login record created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$conn->close();
?>
<html>
<head>

</head>
<body>
	<form action="add_login.php" method="post">
            <p>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </p>
            <input type="submit" value="Login">
            <input type="reset" value="Reset">
            <p>
                <label>No account?</label>
                <a href="Signup.html">Create one!</a>
            </p>
        </form>
</body>
</html>