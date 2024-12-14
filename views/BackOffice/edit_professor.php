<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../controllers/ProfessorController.php';

try {
    $conn = getDatabaseConnection();
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

$professorController = new ProfessorController($conn);

// Initialize variables
$professor = null;
$message = "";

// Handle the GET request to fetch professor details
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $id = trim($_GET['edit_id']);
    $professor = $professorController->searchProfessorById($id);

    if (!$professor) {
        $message = "Professor not found.";
    }
}

// Handle the POST request to update professor details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_professor'])) {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $department = trim($_POST['department']);

    if (!empty($name) && !empty($email) && !empty($department)) {
        $updateSuccess = $professorController->updateProfessor($id, $name, $email, $department);

        if ($updateSuccess) {
            $message = "Professor updated successfully.";
            $professor = $professorController->searchProfessorById($id); // Refresh professor data
        } else {
            $message = "Failed to update professor. Please try again.";
        }
    } else {
        $message = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Professor</title>
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
        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input[type="text"],
        form input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        form button {
            padding: 10px 20px;
            background-color: #4a4e69;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #6b5b95;
        }
        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Edit Professor</h1>

    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <?php if ($professor): ?>
        <form action="edit_professor.php" method="POST">
            <div>
                <label for="id">Professor ID</label>
                <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($professor['id']); ?>" readonly>
            </div>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($professor['name']); ?>" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($professor['email']); ?>" required>
            </div>
            <div>
                <label for="department">Department</label>
                <input type="text" name="department" id="department" value="<?php echo htmlspecialchars($professor['department']); ?>" required>
            </div>
            <button type="submit" name="update_professor">Update</button>
        </form>
    <?php else: ?>
        <p class="error">No professor found to edit. Please go back and try again.</p>
    <?php endif; ?>
</body>
</html>