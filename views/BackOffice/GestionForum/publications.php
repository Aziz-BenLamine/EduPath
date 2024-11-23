<?php
include_once '/xampp/htdocs/EduPath/controllers/publicationC.php';
$publicationC = new publicationC();
$publications = $publicationC->publicationTable();
?>

<h2>PUBLICATIONS</h2>
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
        echo "<tr>";
        echo "<td>" . $publication['titre'] . "</td>";
        echo "<td>" . $publication['contenu'] . "</td>";
        echo "<td>" . $publication['date_creation'] . "</td>";
        echo "<td>" . $publication['cree_par'] . "</td>";
        echo "<td><a href='modifierPublication.php?id=" . $publication['id'] . "&id_sujet=" . $publication['sujet'] . "'>Modifier</a> <a href='supprimerPublication.php?id=" . $publication['id'] . "'>Supprimer</a></td>";
        echo "</tr>";
    }
    ?>
</table>