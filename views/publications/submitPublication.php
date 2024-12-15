<?php
require_once "/xampp/htdocs/EduPath/models/publication.php";
require_once "/xampp/htdocs/EduPath/controllers/publicationC.php";
session_start();
$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['title'];
    $contenu = $_POST['description'];
    $date_creation = date("Y-m-d H:i:s");
    $cree_par = $user_id;;
    $id_sujet = $_GET['id_sujet'];


    $publication = new Publication(null, $titre, $contenu, $date_creation, $cree_par, $id_sujet);
    $publicationC = new publicationC();
    $publicationC->addPublication([
        'titre' => $publication->getTitre(),
        'contenu' => $publication->getContenu(),
        'date_creation' => $publication->getDateCreation(),
        'cree_par' => $publication->getCreePar(),
        'sujet' => $publication->getSujetId()
    ]);

    header("Location: /EduPath/views/publications/publicationsView.php?id=$id_sujet");
    exit();
}
