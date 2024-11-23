<?php
include_once '/xampp/htdocs/EduPath/controllers/sujetForumC.php';
$sujetForumC = new sujetForumC();
$sujets = $sujetForumC->sujetTable();
?>

<h2>SUJETS</h2>
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
        echo "<tr>";
        echo "<td>" . $sujet['title'] . "</td>";
        echo "<td>" . $sujet['description'] . "</td>";
        echo "<td>" . $sujet['date_creation'] . "</td>";
        echo "<td>" . $sujet['cree_par'] . "</td>";
        echo "<td><a href='modifierSujet.php?id=" . $sujet['id'] . "'>Modifier</a> <a href='supprimerSujet.php?id=" . $sujet['id'] . "'>Supprimer</a></td>";
        echo "</tr>";
    }
    ?>
</table>