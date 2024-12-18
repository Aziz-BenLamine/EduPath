<?php
include_once '/xampp/htdocs/EduPath/controllers/publicationC.php';
include_once '/xampp/htdocs/EduPath/controllers/reponseC.php';

include_once '/xampp/htdocs/EduPath/controllers/sujetForumC.php';
$sujetsC = new sujetForumC();
$sujets = $sujetsC->listSujets();

//Publications
$id_publication = $_GET['id'];
$publicationC = new publicationC();
$publication = $publicationC->getPublication($id_publication);


// Get AI response
//$aiResponse = $publicationC->getAIResponse("Explain in simple terms", $publication['contenu']);
$aiResponse = $publicationC->getGeminiResponse($publication['contenu']);


//Reponses

$reponseC = new reponseC();
$reponses = $reponseC->listreponses($id_publication);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment resoudre cette equation?</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/forum_home.css">
    <style>

    </style>
</head>

<body>
    <?php include '/xampp/htdocs/EduPath/views/components/header.php'; ?>
    <div class="container">
        <div class="sidebar">
            <h2>Sujets</h2>
            <ul>
                <?php foreach ($sujets as $sujet): ?>
                    <li><a href="/Edupath/views/publications/publicationsView.php?id=<?= $sujet['id'] ?>"><?= $sujet['title'] ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>

        <main>
            <div class="publication">
                <h1><?= $publication['titre'] ?> </h1>
                <p><?= $publication['contenu'] ?> </p>
                <h2>AI Response</h2>
                <p><?= $aiResponse ?></p>
            </div>

            <section>
                <h2>Responses</h2>
                <ul>
                    <?php foreach ($reponses as $reponse): ?>
                        <li>
                            <div class="name-date">
                                <h4><?= $reponseC->creePar($reponse['cree_par'])['username'] ?></h4>
                                <div><?= $reponseC->timeAgo($reponse['date_creation']) ?></div>
                            </div>
                            <p><?= $reponse['contenu'] ?></p>
                            <a href="modifierReponse.php?id=<?= $reponse['id'] ?>" class="btn-modifier">Modifier</a>
                            <a href="supprimerReponse.php?id=<?= $reponse['id'] ?>" class="btn-supprimer">Supprimer</a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </section>

            <div class="add-response">
                <h2>Rependre</h2>
                <form id="responseForm" action="submitReponse.php?id_publication=<?php echo $id_publication ?>" method="post">
                    <textarea id="responseContent" name="response" placeholder="Ecrire votre response ici..."></textarea><br>
                    <div id="error-message" style="color: red; display: none;">Une reponse doit contenir au moins 4 caractères.</div>

                    <button type="submit" class="response-btn">Rependre</button>
                </form>
            </div>
        </main>
    </div>
</body>
<script>
    document.getElementById('responseForm').addEventListener('submit', function(event) {
        var responseContent = document.getElementById('responseContent').value.trim();
        var errorMessage = document.getElementById('error-message');
        if (responseContent.length < 4) {
            errorMessage.style.display = 'block';
            event.preventDefault();
        } else {
            errorMessage.style.display = 'none';
        }
    });
</script>

</html>