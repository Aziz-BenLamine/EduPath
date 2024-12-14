<?php

// Sujets
require_once "/xampp/htdocs/EduPath/controllers/sujetForumC.php";
$sujetsC = new sujetForumC();
$sujets = $sujetsC->listSujets();
$id_sujet = $_GET['id'];
$sujet_actuel = $sujetsC->getSujet($id_sujet);

// Publication
require_once "/xampp/htdocs/EduPath/controllers/publicationC.php";
$publicationC = new publicationC();
$publications = $publicationC->listPublications($id_sujet);

// Search && sort
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

if ($search) {
    $publications = array_filter($publications, function ($publication) use ($search) {
        return stripos($publication['titre'], $search) !== false;
    });
}

if ($sort) {
    usort($publications, function ($a, $b) use ($sort) {
        switch ($sort) {
            case 'title_asc':
                return strcmp($a['titre'], $b['titre']);
            case 'title_desc':
                return strcmp($b['titre'], $a['titre']);
            case 'date_asc':
                return strtotime($a['date_creation']) - strtotime($b['date_creation']);
            case 'date_desc':
                return strtotime($b['date_creation']) - strtotime($a['date_creation']);
            default:
                return 0;
        }
    });
}

// Pagination
$items_per_page = 3;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$total_items = count($publications);
$total_pages = ceil($total_items / $items_per_page);
$offset = ($current_page - 1) * $items_per_page;
$publications = array_slice($publications, $offset, $items_per_page);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="/Edupath/css/forum_home.css">
    <link rel="stylesheet" type="text/css" href="/Edupath/css/publications.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="main-content">
            <div class="title-bar">
                <h1><?= $sujet_actuel['title'] ?></h1>
                <form id="searchForm" method="GET" action="/Edupath/views/publications/publicationsView.php" class="search-form">
                    <input type="hidden" name="id" value="<?= $id_sujet ?>">
                    <div class="search-container">
                        <input type="text" name="search" placeholder="Recherche par titre" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" class="search-input">
                        <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                    </div>
                    <select name="sort" onchange="document.getElementById('searchForm').submit()" class="search-select">
                        <option value="">Trier par</option>
                        <option value="title_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'title_asc' ? 'selected' : '' ?>>Titre (A-Z)</option>
                        <option value="title_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'title_desc' ? 'selected' : '' ?>>Titre (Z-A)</option>
                        <option value="date_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'date_asc' ? 'selected' : '' ?>>Date (Anciens)</option>
                        <option value="date_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'date_desc' ? 'selected' : '' ?>>Date (Nouveaux)</option>
                    </select>
                </form>
            </div>

            <p><?= $sujet_actuel['description'] ?></p>
            <section>
                <div class="publication-add">
                    <h2>Publications</h2>
                    <a href="/Edupath/views/publications/addPublication.php?id_sujet=<?= $id_sujet ?>" class="add-button">Nouvelle publication</a>
                </div>
                <ul>
                    <?php foreach ($publications as $publication): ?>
                        <li>
                            <div class="name-date">
                                <h4><?= $publication['titre'] ?></h4>
                                <div><?= $publicationC->timeAgo($publication['date_creation']) ?></div>
                            </div>
                            <a href="/Edupath/views/reponses/reponsesView.php?id=<?= $publication['id'] ?>"><?= $publication['contenu'] ?></a>
                            <a class="supprimer-modifier"
                                href="/Edupath/views/publications/supprimerPublication.php?id=<?php echo $publication['id'] ?>
                                                                                         &id_sujet=<?php echo $id_sujet ?>">Supprimer</a>
                            <a class="supprimer-modifier"
                                href="/Edupath/views/publications/modifierPublication.php?id=<?php echo $publication['id'] ?>
                                                                                         &id_sujet=<?php echo $id_sujet ?>">Modifier</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <div class="pagination">
                <?php if ($current_page > 1): ?>
                    <a href="?id=<?= $id_sujet ?>&search=<?= $search ?>&sort=<?= $sort ?>&page=<?= $current_page - 1 ?>">&laquo; Precedent</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?id=<?= $id_sujet ?>&search=<?= $search ?>&sort=<?= $sort ?>&page=<?= $i ?>" class="<?= $i == $current_page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?id=<?= $id_sujet ?>&search=<?= $search ?>&sort=<?= $sort ?>&page=<?= $current_page + 1 ?>">Suivant &raquo;</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</body>

</html>