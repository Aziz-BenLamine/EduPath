
<?php
  include __DIR__ . '/../model/quizModel.php';
  include __DIR__ . '/../controleur/quizControler.php';
  include_once '../quizznourane/config.php';

  
$question = new quizs();
$result = $question->affichequestion(); // Get the list of questions

// Get the id_question from GET or POST request
$id_question = isset($_GET['idq']) ? $_GET['idq'] : (isset($_POST['id_question']) ? $_POST['id_question'] : null);

// Check if id_question is valid
if ($id_question) {
    // Get the max allowed responses and the current response count
    $numR = $question->getNumRForQuestion($id_question);
    $responseCount = $question->getResponseCountForQuestion($id_question);


    // Check if the number of responses is less than the allowed max
    if ($responseCount < $numR) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve and validate the form data
            $reponseText = trim($_POST['reponse'] ?? '');
            $score = trim($_POST['score'] ?? '');
            $correction = trim($_POST['correction'] ?? '');

            // Check if all fields are filled
            if (!empty($reponseText) && !empty($score) && !empty($correction)) {
                // Create a new response object
                $reponse = new Reponse();
                $reponse->setReponseText($reponseText);
                $reponse->setScore($score);
                $reponse->setCorrection($correction);
                $reponse->setId_question($id_question);

                // Add the response to the database
                $quizController = new quizs();
                if ($quizController->addReponse($reponse)) {
                    // Redirect to success message or list page
                    header('Location: index.php?success=1');
                    exit;
                } else {
                    echo "<p style='color: red;'>Failed to add the response. Please try again.</p>";
                }
            } else {
                echo "<p style='color: red;'>All fields are required!</p>";
            }
        }
    } else {
        //echo "<p style='color: red;'>You have reached the maximum number of responses for this question.</p>";
        header('Location: \dashboard\quizznourane\sidebar.php');
        
    }
} else {
    echo "<p style='color: red;'>Invalid or missing question ID.</p>";
}
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
        <h1>Ajouter une Reponse</h1>
        <form  onsubmit="return validateQuiz();" action="" method="POST">
            

            <label for="reponse">reponse: </label>
            <input type="text" id="reponse" name="reponse" placeholder="Entrez la reponse" >



            <label for="score">score: </label>
            <input type="text" id="score" name="score" placeholder="Entrez la titre" >


            <label for="correction">correction: </label>
            <input type="text" id="correction" name="correction" placeholder="Entrez la description" >


            <label for="id_question">ID Question : </label>
            <select id="id_question" name="id_question">
                <option value="">-- Sélectionnez une question --</option>
                <?php
                    
                    

                    foreach ($result as $row) {
                        echo '<option value="' . htmlspecialchars($row['idq']) . '">' . htmlspecialchars($row['idq']) . '</option>';
                    }
                ?>
            </select>


            <button type="submit" name="submit">Ajouter</button>
        </form>
    </div>
    <script> 
        function validateQuiz() {
        // Récupérer les champs du formulaire
        const titre = document.getElementById('titre').value.trim();
        const description = document.getElementById('description').value.trim();
        const categorie = document.getElementById('categorie').value.trim();
        const image = document.getElementById('image').value.trim();

    // Validation
    let test = true;

    // Validation du titre (doit contenir uniquement des lettres et espaces)
    let expr = /^[A-Za-z\s]+$/;
    if (!expr.test(titre) || titre === "") {
        alert("Le titre n'est pas valide. Il doit contenir uniquement des lettres et des espaces.");
        test = false;
    }

    // Validation de la description (doit être remplie)
    else if (description === "") {
        alert("La description ne peut pas être vide.");
        test = false;
    }

    // Validation de la catégorie (doit être remplie)
    else if (categorie === "") {
        alert("La catégorie ne peut pas être vide.");
        test = false;
    }

    // Validation de l'image (doit être sélectionnée)
    else if (image === "") {
        alert("Vous devez sélectionner une image.");
        test = false;
    }

    // Retourne `false` si une validation échoue pour empêcher la soumission du formulaire
    return test;
        }
        
</script>
</body>
</html>
