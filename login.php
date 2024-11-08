<?php
session_start();  

$error_message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    include 'db_connection.php';

    
    $sql = "SELECT * FROM Login WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();


            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;  

              
                header("Location: addpage.html");
                exit;
            } else {
                $error_message = "Invalid password. Please try again.";
            }
        } else {
            $error_message = "No user found with that username. Please sign up first.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Database error: Could not prepare statement.";
    }

    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url('bg2.png');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
        header, footer {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px;
        }
        nav a {
            color: yellow;
            text-decoration: none;
            margin: 0 15px;
        }
        .logout-button {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #ff4d4d;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Store Login</h1>
        <nav>
            <a href="homepage.html">Home</a>
            <a href="https://www.inciflo.com">Inventory Management Guide</a>
            <a href="Signup.html">Sign Up</a>
        </nav>
    </header>

    <div class="container">
        <h2>Employee Login</h2>

        <!-- Display error message if there is one -->
        <?php if ($error_message): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- Login form -->
        <form action="login.php" method="post">
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
    </div>

    <footer>
        <p>&copy; 2024 Store Inc. | <a href="contact.html" style="color: yellow;">Contact Us</a></p>
        <a href="about.html" style="color: yellow;">About Us</a>
    </footer>
</body>
</html>
