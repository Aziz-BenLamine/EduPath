<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Question de Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .response-options {
            display: none;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function showResponseOptions() {
            var typeQuestion = document.getElementById("typeQuestion").value;
            var choixMultiple = document.getElementById("choixMultiple");
            var vraiFaux = document.getElementById("vraiFaux");

            // Cache toutes les options
            choixMultiple.style.display = "none";
            vraiFaux.style.display = "none";

            // Affiche les options en fonction du type de question
            if (typeQuestion === "choixMultiple") {
                choixMultiple.style.display = "block";
            } else if (typeQuestion === "vraiFaux") {
                vraiFaux.style.display = "block";
            }
        }
    </script>
</head>
<body>

    <div class="form-container">
        <h1>Créer une Question de Quiz</h1>
        <form action="submit_question.php" method="post">
            
            <!-- Question -->
            <label for="question">Énoncé de la question :</label>
            <input type="text" id="question" name="question" placeholder="Entrez votre question ici" required>

            <!-- Type de Question -->
            <label for="typeQuestion">Type de question :</label>
            <select id="typeQuestion" name="typeQuestion" onchange="showResponseOptions()" required>
                <option value="">--Sélectionnez le type de question--</option>
                <option value="choixMultiple">Choix Multiple</option>
                <option value="vraiFaux">Vrai/Faux</option>
                <option value="texte">Texte Libre</option>
            </select>

            <!-- Options de Choix Multiple -->
            <div id="choixMultiple" class="response-options">
                <label>Options de réponse :</label>
                <input type="text" name="choix1" placeholder="Option 1"><br>
                <input type="text" name="choix2" placeholder="Option 2"><br>
                <input type="text" name="choix3" placeholder="Option 3"><br>
                <input type="text" name="choix4" placeholder="Option 4">
            </div>

            <!-- Option Vrai/Faux -->
            <div id="vraiFaux" class="response-options">
                <label>Options de réponse :</label>
                <input type="radio" name="vraiFaux" value="Vrai"> Vrai<br>
                <input type="radio" name="vraiFaux" value="Faux"> Faux
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="submit-btn">Créer la Question</button>
        </form>
    </div>

</body>
</html>