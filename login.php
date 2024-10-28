<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "store_database";
    
    $conn = mysqli_connect($servername, $db_username, $db_password, $dbname);
    
    if (!$conn) {
        echo "Could not connect to the database.";
        exit;
    }
    
    $user_table = "CREATE TABLE IF NOT EXISTS User (
    username VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
    )";
    $r1=mysqli_query($conn,$user_table);
	if($user_table)
	{
		echo "<br>'User' table created successfully";
	}
	else
	{
		echo "<br>Failed to create 'User' table";
	}
    // display
    $sql = "SELECT * FROM User WHERE username = '$username' AND password = '$hashed_password'";
    $result = mysqli_query($conn, $sql);
    
   /* // Check if login is successful
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Login successful! Redirecting to employee records.');
                window.open('employee_records.php', '_blank');
              </script>";
    } else {
        echo "<h2>Invalid username or password.</h2>";
    } */
    
    mysqli_close($conn);
}
?>
