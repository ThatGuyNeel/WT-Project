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
    $id = $_POST['id'] ?? '';
    $pname = $_POST['pname'];
    $desc = $_POST['desc'];
    $rprice = $_POST['rprice'];
    $bprice = $_POST['bprice'];
    $qty = $_POST['qty'];
    $supplier = $_POST['supplier'];
    $supplierId = $_POST['supplierId'];
    $wareloc = $_POST['wareloc'];
    $dob = $_POST['dob'];
    $dateLoggedIn = date('Y-m-d H:i:s'); 
	$additional_services = isset($_POST['services']) ? implode(", ", $_POST['services']) : "";

    // Database connection
    include 'db_connection.php';
    // Update product data
    $sql = "UPDATE product SET product_name='$pname', description='$desc', retail_price='$rprice', buy_price='$bprice', quantity='$qty', supplier='$supplier', supplier_id='$supplierId', warehouse_location='$wareloc', expiration_date='$dob', date_logged_in='$dateLoggedIn', additional_services='$additional_services' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
	 if (isset($_GET['id'])) {
        header("Location: edit_product_form.php?id=" . $_GET['id']);
    } else {
        echo "No Product ID specified!";
    }
    exit();
}
?>
