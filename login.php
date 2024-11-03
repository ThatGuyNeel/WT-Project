<?php
session_start();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    include 'db_connection.php';

    
    $user_table = "CREATE TABLE IF NOT EXISTS Login (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,  -- Ensure usernames are unique
        password VARCHAR(255) NOT NULL
    )";

    if (mysqli_query($conn, $user_table)) {
        
    } else {
        echo "<br>Failed to create 'Login' table: " . mysqli_error($conn);
    }
    
    $sql = "SELECT * FROM Login WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
       
        mysqli_stmt_bind_param($stmt, "s", $username);
        
       
        mysqli_stmt_execute($stmt);
        
       
        $result = mysqli_stmt_get_result($stmt);
        
       
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;  
                header("Location: add_product.php");  
                exit;  
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found.";
        }


        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement: " . mysqli_error($conn);
    }

   
    mysqli_close($conn);
}
?>
