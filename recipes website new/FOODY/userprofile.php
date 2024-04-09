<?php
session_start(); // Start the session to access session variables

require "dbinfo.php"; // Include database connection info

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the username from session
$username = $_SESSION['username'];

// Fetch user details from the database
$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT * FROM User_Profile WHERE username = ?";
$statement = $connection->prepare($query);
$statement->bind_param('s', $username);
$statement->execute();
$result = $statement->get_result();
$userData = $result->fetch_assoc();
$statement->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./CSS/Header.css">
    <link rel="stylesheet" href="./CSS/Navbar.css">
    <link rel="stylesheet" href="./CSS/Background.css">
    <link rel="stylesheet" href="./CSS/register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200&display=swap" rel="stylesheet">
    <title>User Profile</title>
</head>

<body>
<div class="header">
    <h1>UniFoodie</h1>
    <a href="index.php"><img style="float: left;" src=Logo.png></a>
    <a href="login.php"><button class="LogOutButton" style="float: right;">Login</button></a>
</div>

<div class="navbar">
    <a href="index.php"><button class="navBarButtons" style="float: left;">Home</button></a>
    <a href="aboutloggedout.php"><button class="navBarButtons" style="float: left;">About</button></a>
</div>

<div class="register-box">
    <h1>User Profile</h1>
    <?php if ($userData): ?>
        <p>Username: <?php echo $userData['username']; ?></p>
        <p>First Name: <?php echo $userData['Forename']; ?></p>
        <p>Last Name: <?php echo $userData['Surname']; ?></p>
        <p>Mobile: <?php echo $userData['mobile']; ?></p>
        <p>Date of Birth: <?php echo $userData['dob']; ?></p>
    <?php else: ?>
        <p>Error: Unable to retrieve user data.</p>
    <?php endif; ?>
</div>

</body>
</html>
