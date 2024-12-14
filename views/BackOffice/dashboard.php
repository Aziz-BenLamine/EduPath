<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../controllers/UserController.php';
require_once __DIR__ . '/../../controllers/ProfessorController.php';

try {
    $conn = config::getConnexion();
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

$userController = new UserController($conn);
$professorController = new ProfessorController($conn);

// Handle delete requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_user'])) {
        $userController->deleteUser($_POST['delete_id']);
    } elseif (isset($_POST['delete_admin'])) {
        $userController->deleteAdmin($_POST['delete_admin_id']);
    } elseif (isset($_POST['delete_professor'])) {
        $professorController->deleteProfessor($_POST['delete_professor_id']);
    }
}

// Handle search request
$searchResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_id'])) {
    $searchId = trim($_POST['search_id']);

    // Search user or admin
    $searchResult = $userController->getUserById($searchId);
    if ($searchResult) {
        $searchResult['type'] = 'User';
    } else {
        $searchResult = $userController->getAdminById($searchId);
        if ($searchResult) {
            $searchResult['type'] = 'Admin';
        }
    }

    // If still not found, search professor
    if (!$searchResult) {
        $searchResult = $professorController->searchProfessorById($searchId);
        if ($searchResult) {
            $searchResult['type'] = 'Professor';
        }
    }
}

// Fetch all users, admins, and professors
$users = $userController->getAllUsers();
$admins = $userController->getAllAdmins();
$professors = $professorController->getAllProfessors();

// Fetch counts for statistics
$totalUsers = $userController->countUsers();
$totalAdmins = $userController->countAdmins();
$totalProfessors = $professorController->countProfessors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }

        h1,
        h2 {
            text-align: center;
        }

        .statistics {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .stat-box {
            background-color: #9a8c98;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e2e2e2;
        }

        form {
            margin: 20px 0;
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

        .edit-button {
            background-color: #f4c430;
        }

        .no-result {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'C:\xampp\htdocs\EduPath\views/components/sidebar.php'; ?>
    <h1>Dashboard</h1>

    <!-- Statistics -->
    <h2>Statistics</h2>
    <div class="statistics">
        <div class="stat-box">Total Users: <?php echo htmlspecialchars($totalUsers); ?></div>
        <div class="stat-box">Total Admins: <?php echo htmlspecialchars($totalAdmins); ?></div>
        <div class="stat-box">Total Professors: <?php echo htmlspecialchars($totalProfessors); ?></div>
    </div>

    <!-- Search -->
    <h2>Search</h2>
    <form action="dashboard.php" method="POST">
        <input type="text" name="search_id" placeholder="Enter ID to search" required>
        <button type="submit">Search</button>
    </form>
    <?php if ($searchResult): ?>
        <h2>Search Result</h2>
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
                    <td><?php echo htmlspecialchars($searchResult['username'] ?? $searchResult['name']); ?></td>
                    <td><?php echo htmlspecialchars($searchResult['email']); ?></td>
                    <td><?php echo htmlspecialchars($searchResult['type']); ?></td>
                </tr>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_id'])): ?>
        <p class="no-result">No results found for ID: <?php echo htmlspecialchars($_POST['search_id']); ?></p>
    <?php endif; ?>

    <!-- Tables -->
    <h2>Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                            <button type="submit" name="delete_user">Delete</button>
                        </form>
                        <form action="edit_user.php" method="GET" style="display:inline;">
                            <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                            <button type="submit" class="edit-button">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Admins</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['id']); ?></td>
                    <td><?php echo htmlspecialchars($admin['username']); ?></td>
                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                    <td>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="delete_admin_id" value="<?php echo htmlspecialchars($admin['id']); ?>">
                            <button type="submit" name="delete_admin">Delete</button>
                        </form>
                        <form action="edit_admin.php" method="GET" style="display:inline;">
                            <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($admin['id']); ?>">
                            <button type="submit" class="edit-button">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Professors</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professors as $professor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($professor['id']); ?></td>
                    <td><?php echo htmlspecialchars($professor['name']); ?></td>
                    <td><?php echo htmlspecialchars($professor['email']); ?></td>
                    <td><?php echo htmlspecialchars($professor['department']); ?></td>
                    <td>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="delete_professor_id" value="<?php echo htmlspecialchars($professor['id']); ?>">
                            <button type="submit" name="delete_professor">Delete</button>
                        </form>
                        <form action="edit_professor.php" method="GET" style="display:inline;">
                            <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($professor['id']); ?>">
                            <button type="submit" class="edit-button">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Overview Chart -->
    <h2>Overview Chart</h2>
    <canvas id="overviewChart"></canvas>
    <script>
        const ctx = document.getElementById('overviewChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Admins', 'Professors'],
                datasets: [{
                    label: 'Counts',
                    data: [<?php echo $totalUsers; ?>, <?php echo $totalAdmins; ?>, <?php echo $totalProfessors; ?>],
                    backgroundColor: ['#9a8c98', '#4a4e69', '#f4c430'],
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>