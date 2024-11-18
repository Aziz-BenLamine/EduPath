
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
        <form action="addquestion.php" method="POST">
            <label for="idq">ID de la Question :</label>
            <input type="number" id="idq" name="idq" placeholder="Entrez l'ID" required>

            <label for="question">Énoncé :</label>
            <input type="text" id="question" name="question" placeholder="Entrez la question" required>

            <label for="typeq">Type de la Question :</label>
            <select id="typeq" name="typeq" required>
                <option value="">--Sélectionnez un type--</option>
                <option value="choixMultiple">Choix Multiple</option>
                <option value="vraiFaux">Vrai/Faux</option>
                <option value="texte">Texte Libre</option>
            </select>

            <button type="submit" name="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>
