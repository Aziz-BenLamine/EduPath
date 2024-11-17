<?php

include '../../controllers/réclamationC.php';


$error = "";
$complaint= null;
$reclamationController = new ReclamationC();


if (

    isset($_POST["id"])  && isset($_POST["nom"]) && isset($_POST["date_c"]) && isset($_POST["email"]) && isset($_POST["sujet"])  && isset($_POST["descript"]) && isset($_POST["tel"])
) {
    if (
        !empty($_POST["id"]) && !empty($_POST["nom"]) && !empty($_POST["date_c"]) && !empty($_POST["email"]) && !empty($_POST["sujet"])  && !empty($_POST["descript"]) && !empty($_POST["tel"])
    ) {
        $complaint= new reclamation (
            $_POST['id'],
            $_POST['nom'],
            new DateTime($_POST['date_c']),
            $_POST['email'],
            $_POST['sujet'],
            $_POST['descript'],
            $_POST['tel']
        );
        //
        $reclamationController->ajouterReclamation($complaint);

        header('Location:addRec.php');
    } else
        $error = "Missing information";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Réclamation</title>
    <link rel="stylesheet" href="style.css">
    <script src="addRec.js"></script>
</head>
<body>
    <div class="container">
        <h2>Formulaire de Réclamation</h2>
        <form action="addRec.php" method="post">
        <div class="form-group">
                <label for="id">ID</label>
                <input type="text" id="id" name="id">
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="date_c">Date</label>
                <input type="date" id="date_c" name="date_c">
            </div>
            <div class="form-group">
                <label for="sujet">Sujet</label>
                <input type="text" id="sujet" name="sujet">
            </div>
            <div class="form-group">
                <label for="descript">Message</label>
                <textarea id="descript" name="descript"></textarea>
            </div>
            <div class="form-group">
                <label for="tel">Numéro de Téléphone</label>
                <input type="tel" id="tel" name="tel">
            </div>
            <button class="btn" type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>