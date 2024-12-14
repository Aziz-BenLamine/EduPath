<?php
include_once '/xampp/htdocs/EduPath/controllers/sujetForumC.php';
$sujetsC = new sujetForumC();
$sujets = $sujetsC->listSujets();
foreach ($sujets as $sujet) {
    echo $sujet['id'] . " - " . $sujet['title'] . "<br>";
}
?>

<h1>Forum de discussion</h1>
<ul>
<?php foreach($sujets as $sujet): ?>
    <li>
        <a href="/Edupath/views/publications/publicationsView.php?id=<?= $sujet['id'] ?>">
            <?= $sujet['title'] ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>