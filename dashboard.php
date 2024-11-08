<?php
session_start();
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Store Inventory</title>
    <style>
        /* Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
			 padding-top: 120px;
            padding-bottom: 80px; 
        }

        /* Header and Footer */
        header, footer {
            width: 100%;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px;
            position: fixed;
            left: 0;
            right: 0;
        }
		header {
			top: 0;
		}
        footer {
            bottom: 0;
        }
        nav a {
            color: yellow;
            text-decoration: none;
            margin: 0 15px;
        }

        /* Main Content */
        main {
            margin-top: 80px;
            padding: 20px;
            text-align: center;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        h2 {
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
		.logout-button {
            position: absolute; top: 15px; right: 15px;
            background-color: #ff4d4d; color: white; padding: 8px 16px;
            border: none; border-radius: 4px; cursor: pointer;
            text-decoration: none;
        }
       .logout-button:hover { background-color: #cc0000; }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <h1>Store Inventory</h1>
    <nav>
        <a href="homepage.html">Home</a>
        <a href="https://www.inciflo.com">Inventory Management Guide</a>
        <a href="Signup.html">Sign Up</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php" class="logout-button">Logout</a>
        <?php endif; ?>
    </nav>
</header>

<!-- Main Content -->
<main>
    <!-- Display Login Records Table -->
    <h2>Login Records</h2>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM login");
    echo "<table>
            <tr><th>ID</th><th>Username</th><th>Password</th></tr>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>
                <td>{$row[0]}</td>
                <td>{$row[1]}</td>
                <td>{$row[2]}</td>
              </tr>";
    }
    echo "</table><a href='login.php'>Add New Login</a>";

    // Display Signup Records Table
    echo "<h2><br>Signup Records</h2>";
    $result = mysqli_query($conn, "SELECT * FROM user");
    echo "<table>
            <tr><th>Employee ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Password</th><th>Phone</th><th>Date of Birth</th><th>Address</th><th>Gender</th><th>Hobbies</th><th>Department</th><th>Favourite colour</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>
                <td>{$row[0]}</td>
                <td>{$row[1]}</td>
                <td>{$row[2]}</td>
                <td>{$row[3]}</td>
                <td>{$row[4]}</td>
                <td>{$row[5]}</td>
                <td>{$row[6]}</td>
                <td>{$row[7]}</td>
                <td>{$row[8]}</td>
                <td>{$row[9]}</td>
                <td>{$row[10]}</td>
                <td>{$row[11]}</td>
                <td>{$row[12]}</td>
                <td>
                    <a href='edit_user.php?employee_id={$row[0]}'>Edit</a> |
                    <a href='delete_user.php?employee_id={$row[0]}'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table><a href='add_user.php'>Add New User</a>";

    // Display Product Records Table
    echo "<h2><br>Product Records</h2>";
    $result = mysqli_query($conn, "SELECT * FROM product");
    echo "<table>
            <tr><th>Product ID</th><th>Product Name</th><th>Description</th><th>Retail Price</th><th>Buy Price</th><th>Quantity</th><th>Supplier</th><th>Supplier ID</th><th>Warehouse Location</th><th>Holding Date</th><th>Date Logged In</th><th>Additional Services</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>
                <td>{$row[0]}</td>
                <td>{$row[1]}</td>
                <td>{$row[2]}</td>
				<td>{$row[3]}</td>
				<td>{$row[4]}</td>
				<td>{$row[5]}</td>
				<td>{$row[6]}</td>
				<td>{$row[7]}</td>
				<td>{$row[8]}</td>
				<td>{$row[9]}</td>
				<td>{$row[10]}</td>
				<td>{$row[11]}</td>
                <td>
                    <a href='edit_product.php?id={$row[0]}'>Edit</a> |
                    <a href='delete_product.php?id={$row[0]}'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table><a href='add_product.php'>Add New Product</a>";
    ?>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Store Inc. | <a href="contact.html" style="color: yellow;">Contact Us</a></p>
    <a href="about.html" style="color: yellow;">About Us</a>
</footer>

</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
