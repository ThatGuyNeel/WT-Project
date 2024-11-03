<?php
// Database connection details
include 'db_connection.php';

// Collect form data
$employee_id = $_POST['employee_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$hobbies = isset($_POST['hobbies']) ? (is_array($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : $_POST['hobbies']) : '';
$department = $_POST['department'];
$fav_color = $_POST['fav_color'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$table="CREATE TABLE IF NOT EXISTS User (
    employee_id VARCHAR(20),
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    phone VARCHAR(20),
    dob DATE,
    address TEXT,
    gender ENUM('Male', 'Female', 'Other'),
    hobbies TEXT,
    department VARCHAR(50),
    fav_color VARCHAR(20)
)";

 $r1=mysqli_query($conn,$table);
	if($table)
	{
		echo "<br>'User' table created successfully";
	}
	else
	{
		echo "<br>Failed to create 'User' table";
	}
// Simple query to insert data into the database
// Query to insert data into the 'User' table
$insert_query = "INSERT INTO User (employee_id, firstname, lastname, email, password, phone, dob, address, gender, hobbies, department, fav_color)
                 VALUES ('$employee_id', '$firstname', '$lastname', '$email', '$hashed_password', '$phone', '$dob', '$address', '$gender', '$hobbies', '$department', '$fav_color')";

// Check if $insert_query is set and not empty before executing
if (!empty($insert_query) && $conn->query($insert_query) === TRUE) {
    echo "Signup successful! <a href='Login.html'>Go to login</a>";
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
