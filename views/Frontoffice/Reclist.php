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
    <style>
        .header {
            width: 100%;
            position: fixed;
            top: -50px;
            left: 0;
            background-color: #f8f9fa;
            transition: top 0.3s;
        }
        .header:hover {
            top: 0;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const statutCell = row.cells[5]; // La cellule du statut
                const modifyButton = row.querySelector('.btn-action');

                if (statutCell.innerText.trim().toLowerCase() === 'traité') {
                    modifyButton.style.pointerEvents = 'none';
                    modifyButton.style.opacity = '0.5';
                }
            });
        });
    </script>
</head>
<body>
<div class="header">
        <?php include '../components/header.php'; ?>
    </div>
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
                    <th>Statut</th>
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
                    echo '<td>' . ($reclamation['statut']) . '</td>';
                    echo '<td>' . ($reclamation['tel']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="modRec.php?id=' . $reclamation['id'] . '" class="btn-action">Modifier</a>';
                    echo '<a href="SuppRec.php?id=' . $reclamation['id'] . '" class="btn-action btn-danger">Supprimer</a>';
                    echo '<a href="downloadRec.php?id=' . htmlspecialchars($reclamation['id']) . '" class="btn-download"><img src="../Frontoffice/assets/download.png" alt="Télécharger" style="width:16px;height:16px;"></a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>