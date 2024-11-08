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
    $employee_id = $_POST['employee_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';
    $department = $_POST['department'];
    $fav_color = $_POST['fav_color'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    include 'db_connection.php';

    // Update user data
    $sql = "UPDATE user SET firstname='$firstname', lastname='$lastname', email='$email', password='$hashed_password', phone='$phone', dob='$dob', address='$address', gender='$gender', hobbies='$hobbies', department='$department', fav_color='$fav_color' WHERE employee_id='$employee_id'";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    header("Location: edit_user_form.php?employee_id=" . $_GET['employee_id']); // Redirect with ID to edit form
    exit();
}
?>
