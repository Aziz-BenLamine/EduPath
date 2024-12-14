<?php
// Include database connection and user controller
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../controllers/UserController.php';

try {
    $conn = getDatabaseConnection();
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

$userController = new UserController($conn);

// Handle search request
$searchResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_id'])) {
    $searchId = trim($_POST['search_id']);

    // Fetch user by ID
    $searchResult = $userController->getUserById($searchId);

    if ($searchResult) {
        $searchResult['type'] = 'User';
    } else {
        // If not found, fetch admin by ID
        $searchResult = $userController->getAdminById($searchId);
        if ($searchResult) {
            $searchResult['type'] = 'Admin';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        thead {
            background-color: #4a4e69;
            color: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #e2e2e2;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #4a4e69;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #6b5b95;
        }
        .no-result {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>


    <?php if ($searchResult): ?>
        <h2>Search Results</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($searchResult['id']); ?></td>
                    <td><?php echo htmlspecialchars($searchResult['username']); ?></td>
                    <td><?php echo htmlspecialchars($searchResult['email']); ?></td>
                    <td><?php echo htmlspecialchars($searchResult['type']); ?></td>
                </tr>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p class="no-result">No results found for ID: <?php echo htmlspecialchars($_POST['search_id']); ?></p>
    <?php endif; ?>
</body>
</html>
