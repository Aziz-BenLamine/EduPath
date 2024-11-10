<?php
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
        <h1>Forum de discussion</h1>
        <p>Bienvenue dans le forum!</p>
        <section>

            <h2>Sujets</h2>
            <ul class="grid-list">
                <?php foreach($sujets as $id => $sujet): ?>
                    <li><a href="?page=publication&id= <?= $id ?>"> <?= $sujet ?> </a></li>
                <?php endforeach; ?>
            </ul>

        </section>
</body>
</html>

