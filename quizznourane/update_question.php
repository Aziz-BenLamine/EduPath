<?php
include('..\quizznourane\model\quizModel.php'); 
include('..\quizznourane\controleur\quizControler.php');


$questionController = new quizs();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['idq'])) {
    $idq = $_GET['idq'];

    // Fetch all questions
    $questions = $questionController->affichequestion();
    $question = null;

    foreach ($questions as $q) {
        if ($q['idq'] == $idq) {
            $question = $q; // Store the matching question
            break;
        }
    }

    if (!$question) {
        echo "Question not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure all necessary POST data is received
    if (
        isset($_POST['idq'], $_POST['question'], $_POST['typeq'], $_POST['id_quiz'], $_POST['numR'])
    ) {
        $idq = $_POST['idq'];
        $newQuestion = $_POST['question'];
        $newTypeq = $_POST['typeq'];
        $newId_quiz = $_POST['id_quiz'];
        $newNumR = $_POST['numR'];

        // Create a new Question object
        $questionObj = new Question();
        $questionObj->setIdq($idq)
            ->setQuestion($newQuestion)
            ->setTypeq($newTypeq)
            ->setId_quiz($newId_quiz)
            ->setNumR($newNumR);

        // Update the question in the database
        $questionController->updatequestion($questionObj, $idq);

        // Redirect after successful update
        header("Location: sidebar.php");
        exit;
    } else {
        echo "Missing POST data.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Recette</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<<body>
    <div class="form-container">
        <h1>Modifier une Question</h1>
        <form onsubmit="return validateForm();" action="update_question.php" method="POST">
            <!-- Hidden field for the question ID -->
            <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">

            <!-- Question Field -->
            <label for="question">Énoncé :</label>
            <input type="text" id="question" name="question" 
                   value="<?= htmlspecialchars($question['question']); ?>" 
                   placeholder="Entrez la question" required>

            <!-- Type of Question Field -->
            <label for="typeq">Type de la Question :</label>
            <select id="typeq" name="typeq" required>
                <option value="">--Sélectionnez un type--</option>
                <option value="choixMultiple" <?= $question['typeq'] === 'choixMultiple' ? 'selected' : ''; ?>>Choix Multiple</option>
                <option value="vraiFaux" <?= $question['typeq'] === 'vraiFaux' ? 'selected' : ''; ?>>Vrai/Faux</option>
                <option value="texte" <?= $question['typeq'] === 'texte' ? 'selected' : ''; ?>>Texte Libre</option>
            </select>

            <!-- Quiz ID Field -->
            <label for="id_quiz">ID du Quiz :</label>
            <input type="text" id="id_quiz" name="id_quiz" 
                   value="<?= htmlspecialchars($question['id_quiz']); ?>" 
                   placeholder="Entrez l'ID du quiz" required>

            <!-- Reference Number Field -->
            <label for="numR">Numéro Référence :</label>
            <input type="number" id="numR" name="numR" 
                   value="<?= htmlspecialchars($question['numR']); ?>" 
                   placeholder="Entrez le numéro de référence" required>

            <!-- Submit Button -->
            <button type="submit">Mettre à Jour</button>
        </form>
    </div>

    <script>
    function validateForm() {
        const question = document.getElementById('question').value.trim();
        const idQuiz = document.getElementById('id_quiz').value.trim();
        const numR = document.getElementById('numR').value.trim();

        if (!question || question.length < 5) {
            alert("La question doit contenir au moins 5 caractères.");
            return false;
        }

        if (!idQuiz || isNaN(idQuiz)) {
            alert("L'ID du Quiz doit être un nombre valide.");
            return false;
        }

        if (!numR || isNaN(numR) || parseInt(numR) <= 0) {
            alert("Le numéro de référence doit être un nombre positif.");
            return false;
        }

        return true;
    }
    </script>
</body>
</html>
