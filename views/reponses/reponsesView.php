<?php
    include_once ROOT_DIR . 'models/publication.php';
    include_once ROOT_DIR . 'controllers/reponseC.php';

    $reponseC = new reponseC();
    $reponses = $reponseC->fetchReponsesTest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment resoudre cette equation?</title>
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
    <div class="publication">
        <h1>Comment resoudre cette equation?</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.     
           Culpa unde maiores, dolore possimus, ratione libero modi dolor
           perspiciatis animi distinctio molestias corrupti inventore repellat
           enim alias quam? Eligendi, tempore iste.
        </p>
    </div>

    <section>
            <h2>Responses</h2>
            <ul>
                <?php foreach($reponses as $reponse): ?>
                    <li>
                        <div class="name-date">
                            <h4><?= $reponse->getCreePar() ?></h4>
                            <div><?=$reponseC->timeAgo($reponse->getDateCreation())?></div>
                        </div>
                        <p><?= $reponse->getContenu()?></p>
                    </li>
                <?php endforeach ?>     
            </ul>
    </section>
    
    <div class="add-response">
        <h2>Rependre</h2>
        <form>
            <textarea name="response" rows="4" cols="50" placeholder="Ecrire votre response ici..."></textarea><br>
            <button type="submit" class="response-btn">Rependre</button>
        </form>
    </div>
    </main>
</body>
</html>