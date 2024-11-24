<?php

include '../../controllers/réclamationC.php';


$error = "";
$complaint= null;
$reclamationController = new ReclamationC();

if (
    isset($_POST["id"])  && isset($_POST["nom"]) && isset($_POST["date_c"]) && isset($_POST["email"]) && isset($_POST["sujet"])  && isset($_POST["descript"]) && isset($_POST["tel"]) && isset($_POST["statut"]) && isset($_POST["is_visble"])
) {
    if (
        !empty($_POST["nom"]) && !empty($_POST["date_c"]) && !empty($_POST["email"]) && !empty($_POST["sujet"])  && !empty($_POST["descript"]) && !empty($_POST["tel"]) && !empty($_POST["statut"]) && !empty($_POST["is_visble"])
    ) {
        $complaint= new reclamation (
            null,
            $_POST['nom'],
            new DateTime($_POST['date_c']),
            $_POST['email'],
            $_POST['sujet'],
            $_POST['descript'],
            $_POST['tel'],
            $_POST['statut'],
            $_POST['is_visble']
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
        <form id="reclamationForm" action="addRec.php" method="post">
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="statut" name="statut" value="en attente">
            <input type="hidden" id="is_visble" name="is_visble" value="1">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom">
                <div class="error-message" id="nom-error"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email">
                <div class="error-message" id="email-error"></div>
            </div>
            <div class="form-group">
                <label for="date_c">Date</label>
                <input type="date" id="date_c" name="date_c">
                <div class="error-message" id="date-error"></div>
            </div>
            <div class="form-group">
                <label for="sujet">Sujet</label>
                <input type="text" id="sujet" name="sujet">
                <div class="error-message" id="sujet-error"></div>
            </div>
            <div class="form-group">
                <label for="descript">Message</label>
                <textarea id="descript" name="descript"></textarea>
                <div class="error-message" id="descript-error"></div>
            </div>
            <div class="form-group">
                <label for="tel">Numéro de Téléphone</label>
                <input type="tel" id="tel" name="tel">
                <div class="error-message" id="tel-error"></div>
            </div>
            <button class="btn" type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>