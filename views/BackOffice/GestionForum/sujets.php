<?php
include_once '/xampp/htdocs/EduPath/controllers/sujetForumC.php';
$sujetForumC = new sujetForumC();
$sujets = $sujetForumC->sujetTable();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sujets</title>
    <link rel="stylesheet" href="/Edupath/css/table.css" />
</head>

<body>
    <h2>Gestion des sujets</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Date de création</th>
            <th>Créé par</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($sujets as $sujet) {
            $cree_par = $sujetForumC->creePar($sujet['cree_par']);
            echo "<tr>";
            echo "<td>" . $sujet['title'] . "</td>";
            echo "<td>" . $sujet['description'] . "</td>";
            echo "<td>" . $sujet['date_creation'] . "</td>";
            echo "<td>" . $cree_par['username'] . "</td>";
            /*echo "<td>" . $sujet['cree_par'] . "</td>";*/
            echo "<td><a href='modifierSujet.php?id=" . $sujet['id'] . "'>Modifier</a> <a href='supprimerSujet.php?id=" . $sujet['id'] . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>