<?php
include '../../controllers/réclamationC.php';

$reclamationController = new ReclamationC();
$error = "";
$reclamation = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reclamation = $reclamationController->afficherReclamation($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id"]) && isset($_POST["nom"]) && isset($_POST["date_c"]) && isset($_POST["email"]) && isset($_POST["sujet"]) && isset($_POST["descript"]) && isset($_POST["tel"]) && isset($_POST["statut"]) && isset($_POST["is_visible"])
    ) {
        if (
            !empty($_POST["nom"]) && !empty($_POST["date_c"]) && !empty($_POST["email"]) && !empty($_POST["sujet"]) && !empty($_POST["descript"]) && !empty($_POST["tel"]) && !empty($_POST["statut"]) && !empty($_POST["is_visible"])
        ) {
            $reclamation = new Reclamation(
                $_POST['id'],
                $_POST['nom'],
                $_POST['date_c'],
                $_POST['email'],
                $_POST['sujet'],
                $_POST['descript'],
                $_POST['tel'],
                $_POST['statut'],
                $_POST['is_visible']
            );
            $reclamationController->modifierReclamation($reclamation, $_POST['id']);
            header('Location:Reclist.php');
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
    <title>Modifier Réclamation</title>
    <link rel="stylesheet" href="styleRec.css">
    <script src="addRec.js" defer></script>
</head>

<body>
    <div class="container">
        <h2>Modifier Réclamation</h2>
        <?php if (isset($error) && !empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form action="modRec.php?id=<?php echo $reclamation['id']; ?>" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo ($reclamation['id']); ?>">
            <input type="hidden" id="statut" name="statut" value="en attente">
            <input type="hidden" id="is_visible" name="is_visible" value="1">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?php echo ($reclamation['nom']); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo ($reclamation['email']); ?>">
            </div>
            <div class="form-group">
                <label for="date_c">Date</label>
                <input type="date" id="date_c" name="date_c" value="<?php echo ($reclamation['date_c']); ?>">
            </div>
            <div class="form-group">
                <label for="sujet">Sujet</label>
                <input type="text" id="sujet" name="sujet" value="<?php echo ($reclamation['sujet']); ?>">
            </div>
            <div class="form-group">
                <label for="descript">Message</label>
                <textarea id="descript" name="descript"><?php echo ($reclamation['descript']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="tel">Numéro de Téléphone</label>
                <input type="tel" id="tel" name="tel" value="<?php echo ($reclamation['tel']); ?>">
            </div>
            <button class="btn" type="submit">Modifier</button>
        </form>
    </div>
</body>

</html>