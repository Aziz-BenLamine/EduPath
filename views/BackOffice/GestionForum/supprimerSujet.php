<?php

include_once "/xampp/htdocs/EduPath/controllers/sujetForumC.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $sujetForumC = new SujetForumC();
    $sujetForumC->deleteSujet($id);

    header("Location: /Edupath/views/BackOffice/GestionForum/forumAdmin.php");
}