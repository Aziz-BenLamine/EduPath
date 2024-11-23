<?php
include_once '/xampp/htdocs/EduPath/controllers/reponseC.php';
$reponseC = new reponseC();
$reponses = $reponseC->reponseTable()
?>

<h2>REPONSES</h2>
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