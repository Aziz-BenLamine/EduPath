<?php
include('..\quizznourane\controleur\quizControler.php');

$quizController = new quizs();
$questions = $quizController->affichequestion();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions List</title>
    <!-- Bootstrap CSS for better styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            display: flex;

        }

        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .table-wrapper {
            margin-top: 30px;
        }

        button {
            padding: 8px 16px;
            cursor: pointer;
        }

        .btn {
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <?php include 'C:\xampp\htdocs\EduPath\views/components/sidebar.php'; ?>
    <?php if (isset($_GET['status'])): ?>
        <div id="notification" class="notification <?= $_GET['status'] === 'success' ? 'success' : 'error'; ?>">
            <span id="notification-text">
                <?= $_GET['status'] === 'success'
                    ? "🎉 quiz ajoutée avec succès !"
                    : "⚠️ Erreur: " . htmlspecialchars($_GET['message'] ?? "Une erreur est survenue."); ?>
            </span>
            <button id="close-notification" onclick="closeNotification()">×</button>
        </div>
    <?php endif; ?>
    <div class="container">
        <h2>Questions List</h2>
        <div class="table-wrapper">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $question): ?>
                        <tr>
                            <td><?= htmlspecialchars($question['idq']); ?></td>
                            <td><?= htmlspecialchars($question['question']); ?></td>
                            <td><?= htmlspecialchars($question['typeq']); ?></td>
                            <td>
                                <!-- Update Button -->
                                <form action="update_question.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">
                                    <input type="hidden" name="question" value="<?= htmlspecialchars($question['question']); ?>">
                                    <input type="hidden" name="typeq" value="<?= htmlspecialchars($question['typeq']); ?>">
                                    <input type="hidden" name="id_quiz" value="<?= htmlspecialchars($question['id_quiz']); ?>">
                                    <input type="hidden" name="numR" value="<?= htmlspecialchars($question['numR']); ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                                <!-- Delete Button -->
                                <form action="delete_question.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this question?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script>
        // Close notification function
        function closeNotification() {
            const notification = document.getElementById("notification");
            notification.style.animation = "fade-out 0.5s ease-out";
            setTimeout(() => notification.remove(), 500); // Remove after fade-out
        }

        // Auto-close notification after 5 seconds
        setTimeout(() => {
            const notification = document.getElementById("notification");
            if (notification) {
                closeNotification();
            }
        }, 30000);
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>