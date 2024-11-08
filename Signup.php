<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $employee_id = $_POST['employee_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? (is_array($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : $_POST['hobbies']) : '';
    $department = $_POST['department'];
    $fav_color = $_POST['fav_color'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $check_user_query = "SELECT * FROM User WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $check_user_query);

    if (mysqli_num_rows($result) > 0) {
        echo "Username or email already exists. Please try again with different credentials.";
        exit; // Stop execution if user already exists
    }

    // Insert user into User table
    $insert_user_query = "INSERT INTO User (employee_id, firstname, lastname, username, email, password, phone, dob, address, gender, hobbies, department, fav_color)
                          VALUES ('$employee_id', '$firstname', '$lastname', '$username', '$email', '$hashed_password', '$phone', '$dob', '$address', '$gender', '$hobbies', '$department', '$fav_color')";

    if ($conn->query($insert_user_query) === TRUE) {
        if ($conn->query($insert_login_query) === TRUE) {
           
            header("Location: dashboard.php");
            exit();
        } 
    } else {
        echo "Error inserting into User table: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html> 
<html> 
<head> 
    <title>Signup</title> 
    <style> 
        body { 
            background-image: url('bg1.jpg'); 
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
        } 
        h2, .button-container { 
            text-align: center; 
        } 
        label, input, select, textarea { 
            width: 100%; 
            margin-bottom: 10px; 
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
    </style> 
</head> 
<body> 
    <!-- Header Section --> 
    <header> 
        <h1>Store Signup</h1> 
        <nav> 
            <a href="homepage.html">Home</a> 
            <a href="Login.html">Employee Login</a> 
            <a href="https://www.inciflo.com">Inventory Management Guide</a> 
        </nav> 
    </header> 

    <!-- Signup Form Section --> 
    <div class="container"> 
        <h2>Employee Signup Registration</h2> 
        <form onsubmit="return validateform()" action="add_user.php" method="POST" enctype="multipart/form-data"> 
            <label for="employee_id">Employee ID:</label> 
            <input type="number" id="employee_id" name="employee_id"> 

            <label for="firstname">First Name:</label> 
            <input type="text" id="firstname" name="firstname"> 

            <label for="lastname">Last Name:</label> 
            <input type="text" id="lastname" name="lastname"> 

            <label for="username">Set Username:</label>
            <input type="text" id="username" name="username">

            <label for="email">Email:</label> 
            <input type="email" id="email" name="email"> 

            <label for="password">Password:</label> 
            <input type="password" id="password" name="password"> 

            <label for="phone">Phone Number:</label> 
            <input type="tel" id="phone" name="phone"> 

            <label for="dob">Date of Birth:</label> 
            <input type="date" id="dob" name="dob"> 

            <label for="address">Address:</label> 
            <textarea id="address" name="address" rows="4"></textarea> 
            <div> 
                <label for="gender">Gender:</label> 
                <input type="radio" id="male" name="gender" value="male"> Male 
                <input type="radio" id="female" name="gender" value="female"> Female 
                <input type="radio" id="other" name="gender" value="other"> Other 
            </div> 
            <br> 
            <div> 
                <label for="hobbies">Hobbies:</label> 
                <input type="checkbox" id="reading" name="hobbies" value="reading"> Reading 
                <input type="checkbox" id="sports" name="hobbies" value="sports"> Sports 
                <input type="checkbox" id="music" name="hobbies" value="music"> Music 
            </div> 
            <br> 
            <label for="department">Department:</label> 
            <select id="department" name="department"> 
                <option value="">Select Department</option> 
                <option value="sales">Sales</option> 
                <option value="hr">HR</option> 
                <option value="it">IT</option> 
                <option value="support">Support</option> 
            </select> 

            <label for="profile_picture">Profile Picture:</label> 
            <input type="file" id="profile_picture" name="profile_picture"> 

            <label for="fav_color">Favorite Color:</label> 
            <input type="color" id="fav_color" name="fav_color"> 

            <div class="button-container"> 
                <input type="submit" value="Register"> 
                <input type="reset" value="Reset"> 
            </div> 
        </form> 
    </div> 

    <!-- Footer Section --> 
    <footer> 
        <p>&copy; 2024 Store Inc. | <a href="contact.html" style="color: yellow;">Contact Us</a></p> 
        <a href="about.html" style="color: yellow;">About Us</a></p> 
    </footer> 
</body> 
</html>
