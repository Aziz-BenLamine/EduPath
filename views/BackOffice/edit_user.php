<?php
session_start();
require_once __DIR__ . '/../../config.php'; // Include config.php
require_once __DIR__ . '/../../controllers/UserController.php'; // Include UserController

// Get the database connection
try {
    $conn = getDatabaseConnection();
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

// Instantiate UserController
$userController = new UserController($conn);

// Get the user ID from the query parameter
$userId = isset($_GET['edit_id']) ? intval($_GET['edit_id']) : null;

// Fetch user data
if ($userId) {
    $user = $userController->getUserById($userId); // Assuming you have a `getUserById` method in UserController
} else {
    die("Invalid User ID");
}

// Handle form submission to update user data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $updateMessage = $userController->updateUser($userId, $username, $email); // Assuming `updateUser` method exists
    if ($updateMessage === true) {
        header("Location: dashboard.php?message=User updated successfully");
        exit();
    } else {
        $errorMessage = $updateMessage;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .form-container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4a4e69;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-container input {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container button {
            background-color: #7494ec;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #506dc0;
        }

        .error-message {
            color: red;
            text-align: center;
        }

        .success-message {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit User</h1>
        <?php if (isset($errorMessage)): ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <button type="submit">Update User</button>
        </form>
    </div>
</body>
</html>