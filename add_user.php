<?php
include 'db_connection.php';
// Initialize variables
$employee_id = $firstname = $lastname = $email = $password = $phone = $dob = $address = $gender = $hobbies = $department = $fav_color = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely
    $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $hobbies = isset($_POST['hobbies']) ? (is_array($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : $_POST['hobbies']) : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';
    $fav_color = isset($_POST['fav_color']) ? $_POST['fav_color'] : '';

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli("localhost", "root", "", "store_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email already exists in the database
    $email_check_query = "SELECT * FROM User WHERE email = ?";
    $stmt = $conn->prepare($email_check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already exists. Please try again with different credentials.";
    } else {
        // Prepare the insert query
        $sql = "INSERT INTO user (employee_id, firstname, lastname, email, password, phone, dob, address, gender, hobbies, department, fav_color)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $employee_id, $firstname, $lastname, $email, $hashed_password, $phone, $dob, $address, $gender, $hobbies, $department, $fav_color);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New user added successfully! <a href='dashboard.php'>Go to Dashboard</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
} else {
    // Redirect to signup page if the form is not submitted
    header("Location: Signup.php"); 
    exit();
}
?>

