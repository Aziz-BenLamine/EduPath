<?php 
    require_once ROOT_DIR . "controllers/publicationC.php";
    $publicationC = new publicationC();
    $publications = $publicationC->fetchPublicationsTest();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="./css/forum_home.css">
</head>
<body>
    <header>
        <img src="views/sujets/logoBG.png" alt="EduPathLogo">
        <nav>
            <ul>
                <!-- TAF INTEGRATION-->
                <li><a href="?page=home">Home</a></li>
                <li><a href="?page=home">Forum</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Mathematiques</h1>
        <p>Mathematiques</p>
        <section>
            <div class="publication-add">
                <h2>Publications</h2>
                <a href="?page=addPublication" class="add-button">Nouvelle publication</a>
            </div>
            <ul>
                <?php foreach($publications as $publication):?>
                    <li>
                        <div class="name-date">
                            <h4><?= $publication->getCreePar()  ?></h4>
                            <div><?= $publicationC->timeAgo($publication->getDateCreation())?></div>
                        </div>
                        <a href="?page=Responses&id=<?= $publication->getId()?>"><?= $publication->getTitre()?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </section>
</body>
</html>

