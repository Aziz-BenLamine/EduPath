<?php
    include_once ROOT_DIR . 'models/publication.php';
    include_once ROOT_DIR . 'controllers/reponseC.php';

    $reponseC = new reponseC();
    $reponses = $reponseC->fetchReponsesTest();

    $sujets = [
        1 => "Mathematiques",
        2 => "Reseaux",
        3 => "Sciences",
        4 => "Intelligence artificielle",
        5 => "Informatique et technologie",
        6 => "Économie et gestion",
        7 => "Physique",
        8 => "Chimie",
        9 => "Biologie",
        10 => "Philosophie",
        11 => "Littérature",
        12 => "Histoire",
        13 => "Géographie",
        14 => "Arts",
        15 => "Musique",
        16 => "Langues étrangères",
        17 => "Psychologie",
        18 => "Sociologie",
        19 => "Anthropologie",
        20 => "Droit",
        21 => "Médecine",
        22 => "Ingénierie",
        23 => "Architecture",
        24 => "Environnement",
        25 => "Astronomie",
        26 => "Éducation",
        27 => "Sport",
        28 => "Cuisine",
        29 => "Voyages",
        30 => "Photographie"
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment resoudre cette equation?</title>
    <link rel="stylesheet" type="text/css" href="./css/forum_home.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        .container {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 250px;
            background-color: #f4f4f4;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
    </style>
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
    <div class="container">
        <div class="sidebar">
            <h2>Sujets</h2>
            <ul>
                <?php foreach($sujets as $id => $sujet): ?>
                    <li><a href="?page=publication&id=<?= $id ?>"><?= $sujet ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
        
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
    </div>
</body>
</html>