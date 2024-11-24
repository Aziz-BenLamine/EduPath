<?php
include('..\quizznourane\model\quizModel.php'); 
include('..\quizznourane\controleur\quizControler.php');
$quizController = new quizs();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['idq'])) {
    $idq = $_GET['idq'];

    // Fetch the question details from the database
    $questions = $quizController->affichequestion();
    $question = null;

    foreach ($questions as $q) {
        if ($q['idq'] == $idq) {
            $question = $q;
            break;
        }
    }

    if (!$question) {
        echo "Question not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $idq = $_POST['idq'];
    $newQuestionText = $_POST['question'];
    $newTypeq = $_POST['typeq'];

    
    $questionObj = new Question();
    $questionObj->setIdq($idq);
    $questionObj->setQuestion($newQuestionText);
    $questionObj->setTypeq($newTypeq);

    
    $quizController->updatequestion($questionObj, $idq);

    
    header("Location: back.php");
    exit;
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
    <title>Modifier une Question</title>
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
        input, select, button {
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
<body>
    <div class="form-container">
        <h1>Modifier une Question</h1>
        <form action="update.php" method="POST">
            <!-- Hidden field for the question ID -->
            <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">

            <!-- Pre-filled fields with current data -->
            <label for="question">Énoncé :</label>
            <input type="text" id="question" name="question" 
                   value="<?= htmlspecialchars($question['question']); ?>" 
                   placeholder="Entrez la question" required>

            <label for="typeq">Type de la Question :</label>
            <select id="typeq" name="typeq" required>
                <option value="">--Sélectionnez un type--</option>
                <option value="choixMultiple" <?= $question['typeq'] === 'choixMultiple' ? 'selected' : ''; ?>>Choix Multiple</option>
                <option value="vraiFaux" <?= $question['typeq'] === 'vraiFaux' ? 'selected' : ''; ?>>Vrai/Faux</option>
                <option value="texte" <?= $question['typeq'] === 'texte' ? 'selected' : ''; ?>>Texte Libre</option>
            </select>

            <button type="submit">Mettre à Jour</button>
        </form>
    </div>
</body>
</html>
