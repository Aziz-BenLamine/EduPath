<?php
include '../../controllers/réclamationC.php';

$reclamationController = new ReclamationC();
$listeReclamations = $reclamationController->listeReclamations();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réclamations</title>
    <link rel="stylesheet" href="styleM.css">
    <script src="addRec.js" defer></script>
</head>
<body>
    <div class="container">
        <h2>Liste des Réclamations</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Sujet</th>
                    <th>Description</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listeReclamations as $reclamation) {
                    echo '<tr>';
                    echo '<td>' .($reclamation['id']) . '</td>';
                    echo '<td>' . ($reclamation['nom']) . '</td>';
                    echo '<td>' . ($reclamation['date_c']) . '</td>';
                    echo '<td>' . ($reclamation['email']) . '</td>';
                    echo '<td>' . ($reclamation['sujet']) . '</td>';
                    echo '<td>' . ($reclamation['descript']) . '</td>';
                    echo '<td>' . ($reclamation['tel']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="modRec.php?id=' . $reclamation['id'] . '" class="btn-action">Modifier</a>';
                    echo '<a href="SuppRec.php?id=' . $reclamation['id'] . '" class="btn-action btn-danger">Supprimer</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>