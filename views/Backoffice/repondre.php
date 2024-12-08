<?php
include '../../controllers/réponseC.php';
include '../../controllers/réclamationC.php';
include 'mail.php';
$reponseController = new ReponseC();
$reclamationController = new ReclamationC();
$error = "";
$reclamation = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reclamation = $reclamationController->afficherReclamation($id);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idr']) && isset($_POST["name_a"]) && isset($_POST["date_r"]) && isset($_POST["contenu"])) {
        if (!empty($_POST["name_a"]) && !empty($_POST["date_r"]) && !empty($_POST["contenu"])) {
            $reponse = new reponse(
                null,
                $_POST['name_a'],
                $id,
                new DateTime($_POST['date_r']),
                $_POST['contenu']
            );
            var_dump($reponse);
            $reponseController->ajouterReponse($reponse);
            $resultatEmail = envoyerEmail(
                $reclamation['email'],
                $reclamation['nom'],
                $reclamation['sujet'],
                $_POST['contenu']
            );
            if ($resultatEmail !== true) {
                // Gérer l'erreur d'envoi d'email
                echo $resultatEmail;
            }
            header('Location:listeRec.php'); // Rediriger vers la liste des réclamations après ajout de la réponse
            exit();
        } else {
            $error = "Informations manquantes";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre à une Réclamation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f7ff; /* Bleu clair */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin: 20px;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #0056b3; /* Bleu foncé */
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #b3d9ff; /* Bordure bleu clair */
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 150px; /* Augmente la hauteur de la zone de texte */
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #0056b3; /* Bordure bleu foncé au focus */
            outline: none;
        }

        .btn {
            background-color: #0056b3; /* Bleu foncé */
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #004494; /* Bleu encore plus foncé au survol */
        }
        .btn:disabled {
            background-color: #b3b3b3; /* Gris */
            cursor: not-allowed;
        }
        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
        .info p {
            margin: 5px 0;
        }

        .info p span {
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="info">
            <h2>Informations de la Réclamation</h2>
            <?php if (isset($reclamation)) { ?>
                <p><span>ID:</span> <?php echo htmlspecialchars($reclamation['id']); ?></p>
                <p><span>Nom:</span> <?php echo htmlspecialchars($reclamation['nom']); ?></p>
                <p><span>Date:</span> <?php echo htmlspecialchars($reclamation['date_c']); ?></p>
                <p><span>Email:</span> <?php echo htmlspecialchars($reclamation['email']); ?></p>
                <p><span>Sujet:</span> <?php echo htmlspecialchars($reclamation['sujet']); ?></p>
                <p><span>Description:</span> <?php echo htmlspecialchars($reclamation['descript']); ?></p>
                <p><span>Téléphone:</span> <?php echo htmlspecialchars($reclamation['tel']); ?></p>
                <input type="hidden" id="statut" value="<?php echo htmlspecialchars($reclamation['statut']); ?>">
            <?php } else { ?>
                <p>Réclamation non trouvée.</p>
            <?php } ?>
        </div>
        <div class="form">
            <h2>Répondre à une Réclamation</h2>
            <?php if (isset($error) && !empty($error)) { ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php } ?>
            <?php if (isset($reclamation)) { ?>
            <form id="reponseForm" action="repondre.php?id=<?php echo htmlspecialchars($reclamation['id']); ?>" method="post">
                <div class="form-group">
                    <input type="hidden" id="idr" name="idr">
                    <label for="name_a">Nom de l'Administrateur</label>
                    <input type="text" id="name_a" name="name_a" onkeyup="validateName()">
                    <div class="error-message" id="name-error"></div>
                </div>
                <div class="form-group">
                    <label for="date_r">Date</label>
                    <input type="date" id="date_r" name="date_r" onchange="validateDate()">
                    <div class="error-message" id="date-error"></div>
                </div>
                <div class="form-group">
                    <label for="contenu">Réponse</label>
                    <textarea id="contenu" name="contenu" onkeyup="validateContenu()"></textarea>
                    <div class="error-message" id="contenu-error"></div>
                </div>
                <button class="btn" type="submit" id="submitBtn" onclick="validateForm(event)">Envoyer</button>
            </form>
            <?php } ?>
        </div>
    </div>
    <script src="cntrl.js"></script>
</body>
</html>