<?php
include '/xampp/htdocs/EduPath/controllers/réclamationC.php';



$reclamationController = new ReclamationC();
$listeReclamationsMasquees = $reclamationController->listeReclamationsMasquees();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réclamations Masquées</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f7ff;
            /* Bleu clair */
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
            /* Réduire la largeur de la table */
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

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #0056b3;
            /* Bleu foncé */
            color: white;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .actions {
            width: 150px;
            /* Ajuster la largeur de la colonne des actions */
        }

        .actions a {
            display: inline-block;
            padding: 5px 10px;
            /* Réduire la taille du bouton */
            margin-right: 5px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #0056b3;
            /* Bleu foncé */
        }

        .actions a:hover {
            background-color: #004494;
            /* Bleu encore plus foncé au survol */
        }

        .actions a.btn-danger {
            background-color: #d9534f;
            /* Rouge pour le bouton Supprimer */
        }

        .actions a.btn-danger:hover {
            background-color: #c9302c;
            /* Rouge plus foncé au survol pour le bouton Supprimer */
        }
    </style>

</head>

<body>
    <?php include 'C:\xampp\htdocs\EduPath\views/components/sidebar.php'; ?>
    <div class="container">
        <h2>Réclamations Masquées</h2>
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
                foreach ($listeReclamationsMasquees as $reclamation) {
                    echo '<tr data-id="' . htmlspecialchars($reclamation['id']) . '">';
                    echo '<td>' . htmlspecialchars($reclamation['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($reclamation['nom']) . '</td>';
                    echo '<td>' . htmlspecialchars($reclamation['date_c']) . '</td>';
                    echo '<td>' . htmlspecialchars($reclamation['sujet']) . '</td>';
                    echo '<td>' . htmlspecialchars($reclamation['statut']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="hidden.php?id=' . htmlspecialchars($reclamation['id']) . ' class="btn-action btn-unhide">Afficher</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>