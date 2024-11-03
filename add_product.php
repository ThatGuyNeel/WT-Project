<?php
// Initialize variables
$pname = "";
$desc = "";
$rprice = "";
$bprice = "";
$qty = "";
$supplier = "";
$supplierId = "";
$wareloc = "";
$dob = "";
$dateLoggedIn = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pname = $_POST['pname'];
    $desc = $_POST['desc'];
    $rprice = $_POST['rprice'];
    $bprice = $_POST['bprice'];
    $qty = $_POST['qty'];
    $supplier = $_POST['supplier'];
    $supplierId = $_POST['supplierId'];
    $wareloc = $_POST['wareloc'];
    $dob = $_POST['dob'];
    $dateLoggedIn = date('Y-m-d H:i:s'); // Current date and time

    // Database connection
    include 'db_connection.php';
    // Insert data into the Product table
    $sql = "INSERT INTO Product (pname, description, retail_price, buy_price, quantity, supplier, supplier_id, warehouse_location, expiration_date, date_logged_in)
            VALUES ('$pname', '$desc', '$rprice', '$bprice', '$qty', '$supplier', '$supplierId', '$wareloc', '$dob', '$dateLoggedIn')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    header("Location: add_product_form.php"); // Redirect to form page
    exit();
}
?>
