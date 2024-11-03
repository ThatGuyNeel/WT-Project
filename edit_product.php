<?php
// Initialize variables
$id = "";
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
    $id = $_POST['id'];
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
    // Update product data
    $sql = "UPDATE Product SET pname='$pname', description='$desc', retail_price='$rprice', buy_price='$bprice', quantity='$qty', supplier='$supplier', supplier_id='$supplierId', warehouse_location='$wareloc', expiration_date='$dob', date_logged_in='$dateLoggedIn' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    header
