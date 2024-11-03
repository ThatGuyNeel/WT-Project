<?php
session_start();
?>

<nav>
    <a href="homepage.php">Home</a>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="Signup.php">Signup</a>
    <?php endif; ?>
</nav>
