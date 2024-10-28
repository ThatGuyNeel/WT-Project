<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
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
    
    // Simple query without prepared statements
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    // Check if login is successful
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Login successful! Redirecting to employee records.');
                window.open('employee_records.php', '_blank');
              </script>";
    } else {
        echo "<h2>Invalid username or password.</h2>";
    }
    
    mysqli_close($conn);
}
?>
