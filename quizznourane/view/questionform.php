<?php
include __DIR__ . '/../model/quizModel.php';
include __DIR__ . '/../controleur/quizControler.php';
$quizController = new quizs();

    
$result = $quizController->afficheQuiz();


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Question</title>
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
        <h1>Ajouter une Question</h1>
        <form onsubmit="return validateForm();" action="addquestion.php" method="POST">
    <label for="idq">ID de la Question :</label>
    <input type="number" id="idq" name="idq" placeholder="Entrez l'ID">

    <label for="question">Énoncé :</label>
    <input type="text" id="question" name="question" placeholder="Entrez la question">


    <label for="typeq">Type de la Question :</label>
            <select id="typeq" name="typeq" >
                <option value="">--Sélectionnez un type--</option>
                <option value="choixMultiple">Choix Multiple</option>
                <option value="vraiFaux">Vrai/Faux</option>
                <option value="texte">Texte Libre</option>
            </select>
    <label for="id_quiz">Quiz :</label>


    <select id="id_quiz" name="id_quiz">
        <option value="">-- Sélectionnez un QUIZ --</option>
        <?php
        // Assurez-vous que $result contient les données des quizzes
        foreach ($result as $row) {
            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) ."  " .  htmlspecialchars($row['titre']) .'</option>';
        }
        ?>
    </select>
    <label for="numR">Énoncé :</label>
    <input type="number" id="numR" name="numR" placeholder="Entrez combien de reponse possible">

    <button type="submit" name="submit">Ajouter</button>
</form>

<script>
function validateForm() {
    // Récupérer les champs du formulaire
    const idq = document.getElementById('idq').value.trim();
    const question = document.getElementById('question').value.trim();
    const id_quiz = document.getElementById('id_quiz').value.trim();

    // Validation de l'ID de la question
    if (!idq || isNaN(idq) || parseInt(idq) <= 0) {
        alert("L'ID de la question doit être un nombre positif.");
        return false;
    }

    // Validation de l'énoncé
    if (!question || question.length < 5) {
        alert("L'énoncé doit contenir au moins 5 caractères.");
        return false;
    }

    // Validation du Quiz
    if (!id_quiz) {
        alert("Veuillez sélectionner un quiz.");
        return false;
    }

    // Si toutes les validations passent
    return true;
}
</script>

</body>
</html>
