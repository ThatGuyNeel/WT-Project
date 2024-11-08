<?php
// Include database connection
include 'db_connection.php';

// Retrieve employee ID from URL and assign it to the correct variable
$employee_id = $_GET['employee_id'] ?? '';

// Check if employee ID is correctly retrieved
if (!$employee_id) {
    echo "No Employee ID specified!";
    exit();
}

// Fetch user details from database
$sql = "SELECT * FROM user WHERE employee_id='$employee_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $password = $row['password'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $address = $row['address'];
    $gender = $row['gender'];
    $hobbies = explode(", ", $row['hobbies']);
    $department = $row['department'];
    $fav_color = $row['fav_color'];
} else {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User Information</h2>
    <form action="edit_user.php" method="POST">
        <!-- Hidden input for employee ID -->
        <input type="hidden" name="employee_id" value="<?php echo htmlspecialchars($employee_id); ?>">
       
        <!-- Displayed fields for other details -->
        <label>First Name:</label>
        <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>"><br>

        <label>Last Name:</label>
        <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
		
        <label>Password:</label>
        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required><br>

        <label>Phone:</label>
        <input type="tel" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>

        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>"><br>

        <label>Address:</label>
        <textarea name="address"><?php echo htmlspecialchars($address); ?></textarea><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="male" <?php if ($gender == 'male') echo 'checked'; ?>> Male
        <input type="radio" name="gender" value="female" <?php if ($gender == 'female') echo 'checked'; ?>> Female
        <input type="radio" name="gender" value="other" <?php if ($gender == 'other') echo 'checked'; ?>> Other<br>

        <label>Hobbies:</label>
        <input type="checkbox" name="hobbies[]" value="reading" <?php if (in_array("reading", $hobbies)) echo 'checked'; ?>> Reading
        <input type="checkbox" name="hobbies[]" value="sports" <?php if (in_array("sports", $hobbies)) echo 'checked'; ?>> Sports
        <input type="checkbox" name="hobbies[]" value="music" <?php if (in_array("music", $hobbies)) echo 'checked'; ?>> Music<br>

        <label>Department:</label>
        <select name="department">
            <option value="sales" <?php if ($department == 'sales') echo 'selected'; ?>>Sales</option>
            <option value="hr" <?php if ($department == 'hr') echo 'selected'; ?>>HR</option>
            <option value="it" <?php if ($department == 'it') echo 'selected'; ?>>IT</option>
            <option value="support" <?php if ($department == 'support') echo 'selected'; ?>>Support</option>
        </select><br>

        <label>Favorite Color:</label>
        <input type="color" name="fav_color" value="<?php echo htmlspecialchars($fav_color); ?>"><br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
