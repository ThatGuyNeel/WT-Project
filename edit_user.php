<?php
// Initialize variables
$id = "";
$employee_id = "";
$firstname = "";
$lastname = "";
$email = "";
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
    $id = $_POST['id'];
    $employee_id = $_POST['employee_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';
    $department = $_POST['department'];
    $fav_color = $_POST['fav_color'];

    // Database connection
	include 'db_connection.php';

    // Update user data
    $sql = "UPDATE users SET employee_id='$employee_id', firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', dob='$dob', address='$address', gender='$gender', hobbies='$hobbies', department='$department', fav_color='$fav_color' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    header("Location: edit_user_form.php?id=" . $_GET['id']); // Redirect with ID to edit form
    exit();
}
?>
