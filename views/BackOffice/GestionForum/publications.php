<?php
include_once '/xampp/htdocs/EduPath/controllers/publicationC.php';
$publicationC = new publicationC();
$publications = $publicationC->publicationTable();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications</title>
    <link rel="stylesheet" href="/Edupath/css/table.css" />
</head>

<body>
    <h2>Gestion des publications</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Date de création</th>
            <th>Créé par</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($publications as $publication) {
            $cree_par = $publicationC->creePar($publication['cree_par']);
            echo "<tr>";
            echo "<td>" . $publication['titre'] . "</td>";
            echo "<td>" . $publication['contenu'] . "</td>";
            echo "<td>" . $publication['date_creation'] . "</td>";
            echo "<td>" . $cree_par['username'] . "</td>";
            echo "<td><a href='modifierPublication.php?id=" . $publication['id'] . "&id_sujet=" . $publication['sujet'] . "'>Modifier</a> <a href='supprimerPublication.php?id=" . $publication['id'] . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>