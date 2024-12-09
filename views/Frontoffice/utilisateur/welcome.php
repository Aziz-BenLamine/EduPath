<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: indexform.php"); // Redirect to login if not logged in
    exit;
}

// Get the logged-in user's username
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hello, <?= htmlspecialchars($username) ?>!</h1>
        <p>Welcome to your dashboard.</p>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
