<?php
require_once "/xampp/htdocs/EduPath/models/sujetForum.php";
require_once "/xampp/htdocs/EduPath/controllers/sujetForumC.php";
session_start();
$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['title'];
    $description = $_POST['description'];
    $date_creation = date("Y-m-d H:i:s");
    $cree_par = $user_id;

    $sujet = new SujetForum(null, $titre, $description, $date_creation, $cree_par);
    $sujetC = new sujetForumC();
    $sujetC->addSujet([
        'title' => $sujet->getTitre(),
        'description' => $sujet->getDescription(),
        'date_creation' => $sujet->getDateCreation(),
        'cree_par' => $sujet->getCreePar()
    ]);

    header("Location: /EduPath/views/sujets/forum_home.php");
    exit();
}
