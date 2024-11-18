<?php
include('../controleur/quizControler.php');

$quizController = new quizs();
$questions = $quizController->affichequestion();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Questions List</h2>
    <table>
        <thead>
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
                        <form action="update_question.php" method="GET" style="display:inline;">
                            <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="delete_question.php" method="POST" style="display:inline;">
                            <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this question?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
