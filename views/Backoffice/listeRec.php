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
    <script src="hide.js"></script>
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
            width: 100%; /* Réduire la largeur de la table */
            max-width: 1000px;
            margin: 20px auto;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #0056b3; /* Bleu foncé */
            color: white;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .actions {
            width: 200px; /* Réduire la largeur de la colonne des actions */
        }

        .actions a {
            display: inline-block;
            padding: 5px 10px; /* Réduire la taille du bouton */
            margin-right: 5px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #0056b3; /* Bleu foncé */
        }

        .actions a:hover {
            background-color: #004494; /* Bleu encore plus foncé au survol */
        }
    </style>
</head>
<body>
    <?php include 'sidebar.html'; ?>
    <div class="container">
        <h2>Liste des Réclamations</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Sujet</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listeReclamations as $reclamation) {
                    if ($reclamation['is_visible'] == 1) {
                    echo '<tr>';
                    echo '<td>' . ($reclamation['id']) . '</td>';
                    echo '<td>' . ($reclamation['nom']) . '</td>';
                    echo '<td>' . ($reclamation['date_c']) . '</td>';
                    echo '<td>' . ($reclamation['sujet']) . '</td>';
                    echo '<td>' . ($reclamation['statut']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="repondre.php?id=' . ($reclamation['id']) . '" class="btn-action">Répondre</a>';
                    echo '<a href="hide.php?id=' . htmlspecialchars($reclamation['id']) . '" class="btn-action btn-hide">Masquer</a>';
                    echo '</td>';
                    echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>