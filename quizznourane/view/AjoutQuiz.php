
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
        <h1>Ajouter une Quiz</h1>
        <form  onsubmit="return validateQuiz();" action="addQuiz.php" method="POST">
            

            



            <label for="titre">titre: </label>
            <input type="text" id="titre" name="titre" placeholder="Entrez la titre" >


            <label for="description">description: </label>
            <input type="text" id="description" name="description" placeholder="Entrez la description" >


            <label for="categorie">categorie: </label>
            <input type="text" id="categorie" name="categorie" placeholder="Entrez la categorie" >


            <label for="image">image: </label>
            <input type="file" id="image" name="image" placeholder="Entrez la image" >
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
    }, 5000);
</script>

</body>
</html>
