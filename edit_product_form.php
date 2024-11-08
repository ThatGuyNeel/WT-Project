<?php
include 'db_connection.php';

$id = $_GET['id'] ?? '';

$pname = $desc = $rprice = $bprice = $qty = $supplier = $supplierId = $wareloc = $dob = $dateLoggedIn = "";
$additional_services = [];
if ($id) {
    $sql = "SELECT * FROM product WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pname = $row['product_name'];
        $desc = $row['description'];
        $rprice = $row['retail_price'];
        $bprice = $row['buy_price'];
        $qty = $row['quantity'];
        $supplier = $row['supplier'];
        $supplierId = $row['supplier_id'];
        $wareloc = $row['warehouse_location'];
        $dob = $row['expiration_date'];
        $dateLoggedIn = $row['date_logged_in'];
        $additional_services = explode(", ", $row['additional_services']);
    } else {
        echo "Product not found!";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();
} else {
    echo "No Product ID specified!";
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product Information</h2>
    <form action="edit_product.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <label>Product Name:</label>
        <input type="text" name="pname" value="<?php echo htmlspecialchars($pname); ?>"><br>

        <label>Description:</label>
        <textarea name="desc"><?php echo htmlspecialchars($desc); ?></textarea><br>

        <label>Retail Price:</label>
        <input type="number" step="0.01" name="rprice" value="<?php echo htmlspecialchars($rprice); ?>"><br>

        <label>Buy Price:</label>
        <input type="number" step="0.01" name="bprice" value="<?php echo htmlspecialchars($bprice); ?>"><br>

        <label>Quantity:</label>
        <input type="number" name="qty" value="<?php echo htmlspecialchars($qty); ?>"><br>

        <label>Supplier:</label>
        <input type="text" name="supplier" value="<?php echo htmlspecialchars($supplier); ?>"><br>

        <label>Supplier ID:</label>
        <input type="text" name="supplierId" value="<?php echo htmlspecialchars($supplierId); ?>"><br>

        <label>Warehouse Location:</label>
        <input type="text" name="wareloc" value="<?php echo htmlspecialchars($wareloc); ?>"><br>

        <label>Intended Holding Period Date in the Warehouse:</label>
        <input type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>"><br>

		<label>Additional Services:</label><br>
		<input type="checkbox" name="services[]" value="Needs Refrigeration" <?php if (in_array("Needs Refrigeration", $additional_services)) echo 'checked'; ?>> Needs Refrigeration<br>
		<input type="checkbox" name="services[]" value="Special Handling" <?php if (in_array("Special Handling", $additional_services)) echo 'checked'; ?>> Special Handling<br>
		<input type="checkbox" name="services[]" value="Fragile" <?php if (in_array("Fragile", $additional_services)) echo 'checked'; ?>> Fragile<br>
		<input type="checkbox" name="services[]" value="Gift Wrapping" <?php if (in_array("Gift Wrapping", $additional_services)) echo 'checked'; ?>> Gift Wrapping<br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
