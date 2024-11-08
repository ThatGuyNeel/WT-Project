<?php
include 'db_connection.php';

$product_id = "";       
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
    $supplierId = "ID_" . strtoupper(substr($supplier, 9, 1)); 
    $wareloc = $_POST['wareloc'];
    $dob = $_POST['dob'];
    $dateLoggedIn = date('Y-m-d H:i:s'); 
	$additional_services = isset($_POST['services']) ? implode(", ", $_POST['services']) : "";

	
// SQL to create Product table
$sql = "CREATE TABLE IF NOT EXISTS product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    retail_price DECIMAL(10, 2) NOT NULL,
    buy_price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    supplier VARCHAR(100) NOT NULL,
	supplier_id VARCHAR(50),
	warehouse_location VARCHAR(100) NOT NULL,
	expiration_date DATE,
    date_logged_in TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	additional_services VARCHAR(255)
)";

switch ($supplier) {
    case 'Supplier A':
        $supplierId = 'ID001';
        break;
    case 'Supplier B':
        $supplierId = 'ID002';
        break;
    case 'Supplier C':
        $supplierId = 'ID003';
        break;
    case 'Supplier D':
        $supplierId = 'ID004';
        break;
    case 'Supplier E':
        $supplierId = 'ID005';
        break;
    default:
        $supplierId = '';  
}
if ($conn->query($sql) === TRUE) {
    echo "Table 'Product' created successfully.";
    $sql = "INSERT INTO product (product_name, description, retail_price, buy_price, quantity, supplier, supplier_id, warehouse_location, expiration_date, date_logged_in, additional_services)
            VALUES ('$pname', '$desc', '$rprice', '$bprice', '$qty', '$supplier', '$supplierId', '$wareloc', '$dob', '$dateLoggedIn', '$additional_services')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error creating table: " . $conn->error;
}

}

$conn->close();
?>
