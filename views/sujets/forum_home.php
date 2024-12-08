<?php

include_once '/xampp/htdocs/EduPath/controllers/sujetForumC.php';
$sujetsC = new sujetForumC();
$sujets = $sujetsC->listSujets();
//QUOTE
$quoteData = $sujetsC->getLearningQuote();
$quote = $quoteData['quote'];
$author = $quoteData['author'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/forum_home.css">
</head>

<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <main>
        <h1>Forum de discussion</h1>
        <p>Bienvenue dans le forum!</p>
        <section>
            <div class="publication-add">
                <h2>Sujets</h2>
                <a href="/Edupath/views/sujets/addSujet.php" class="add-button">Ajouter un sujet</a>
            </div>

            <ul class="grid-list">
                <?php foreach ($sujets as $sujet): ?>
                    <li>
                        <a href="/Edupath/views/publications/publicationsView.php?id=<?= $sujet['id'] ?>">
                            <?= $sujet['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </section>
        <section class="inspirational-quote">
            <blockquote>
                <p>"<?= $quote ?>"</p>
                <footer>- <?= $author ?></footer>
            </blockquote>
        </section>
    </main>
</body>

</html>