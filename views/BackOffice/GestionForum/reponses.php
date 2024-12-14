<?php
include_once '/xampp/htdocs/EduPath/controllers/reponseC.php';
$reponseC = new reponseC();
$reponses = $reponseC->reponseTable();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réponses</title>
    <link rel="stylesheet" href="/Edupath/css/table.css" />
</head>
<body>
    <h2>Gestion des reponses</h2>
    <table>
        <tr>
            <th>Contenu</th>
            <th>Date de création</th>
            <th>Créé par</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($reponses as $reponse) {
            $cree_par = $reponseC->creePar($reponse['cree_par']);
            echo "<tr>";
            echo "<td>" . $reponse['contenu'] . "</td>";
            echo "<td>" . $reponse['date_creation'] . "</td>";
            echo "<td>" . $cree_par['nom'] . " " . $cree_par['prenom'] . "</td>";
            echo "<td><a href='modifierReponse.php?id=" . $reponse['id'] . "'>Modifier</a> <a href='supprimerReponse.php?id=" . $reponse['id'] . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>