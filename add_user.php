<?php
// Initialize variables
$employee_id = "";
$firstname = "";
$lastname = "";
$email = "";
$password = "";
$phone = "";
$dob = "";
$address = "";
$gender = "";
$hobbies = "";
$department = "";
$fav_color = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employee_id = $_POST['employee_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';
    $department = $_POST['department'];
    $fav_color = $_POST['fav_color'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli("localhost", "root", "", "store_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the users table
    $sql = "INSERT INTO users (employee_id, firstname, lastname, email, password, phone, dob, address, gender, hobbies, department, fav_color)
            VALUES ('$employee_id', '$firstname', '$lastname', '$email', '$hashed_password', '$phone', '$dob', '$address', '$gender', '$hobbies', '$department', '$fav_color')";

    if ($conn->query($sql) === TRUE) {
        echo "New user added successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    header("Location: signup_form.php"); // Replace with your signup form page
    exit();
}
?>
