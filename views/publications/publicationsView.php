<?php 
    ///Sujets
    require_once "/xampp/htdocs/EduPath/controllers/sujetForumC.php";
    $sujetsC = new sujetForumC();
    $sujets = $sujetsC->listSujets();
    $id_sujet = $_GET['id'];
    $sujet_actuel = $sujetsC->getSujet($id_sujet);

   //Publication
    require_once "/xampp/htdocs/EduPath/controllers/publicationC.php";
    $publicationC = new publicationC();
    $publications = $publicationC->listPublications($id_sujet);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
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
                <?php foreach($sujets as $sujet): ?>
                    <li><a href="/Edupath/views/publications/publicationsView.php?id=<?= $sujet['id'] ?>"><?= $sujet['title'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="main-content">
            <h1><?= $sujet_actuel['title']?></h1>
            <p><?= $sujet_actuel['description']?></p>
            <section>
                <div class="publication-add">
                    <h2>Publications</h2>
                    <a href="/Edupath/views/publications/addPublication.php?id_sujet=<?=$id_sujet ?>" class="add-button">Nouvelle publication</a>
                </div>
                <ul>
                    <?php foreach($publications as $publication): ?>
                        <li>
                            <div class="name-date">
                                <h4><?= $publication['titre'] ?></h4>
                                <div><?= $publicationC->timeAgo($publication['date_creation']) ?></div>
                            </div>
                            <a href="/Edupath/views/reponses/reponsesView.php?id=<?= $publication['id'] ?>"><?= $publication['contenu'] ?></a>
                            <a class="supprimer-modifier"
                               href="/Edupath/views/publications/supprimerPublication.php?id=<?php echo $publication['id']?>
                                                                                         &id_sujet=<?php echo $id_sujet ?>">Supprimer</a>
                            <a class="supprimer-modifier" href="">Modifier</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </div>
    </div>
</body>
</html>