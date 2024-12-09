<?php
require_once '../../Database.php';
require_once '../../User.php';

$database = new Database();
$userModel = new User($database->getConnection());

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($action === 'show' && $id) {
    $user = $userModel->getUserById($id);
    if ($user) {
        echo "<h2>User Details</h2>";
        echo "<p>ID: {$user['id']}</p>";
        echo "<p>Username: {$user['username']}</p>";
        echo "<p>Email: {$user['email']}</p>";
    } else {
        echo "User not found.";
    }
} elseif ($action === 'delete' && $id) {
    $userModel->deleteUser($id);
    header('Location: dashboard.php');
    exit;
} elseif ($action === 'edit' && $id) {
    $user = $userModel->getUserById($id);
    if ($user) {
        ?>
        <form method="POST" action="?action=update&id=<?= htmlspecialchars($id) ?>">
            <label>Username:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            <button type="submit">Update</button>
        </form>
        <?php
    } else {
        echo "User not found.";
    }
} elseif ($action === 'update' && $id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel->updateUser($id, $_POST['username'], $_POST['email']);
    header('Location: dashboard.php');
    exit;
}
?>
