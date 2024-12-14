<?php

include_once "/xampp/htdocs/EduPath/controllers/reponseC.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $reponseC = new reponseC();
    $reponseC->deleteReponse($id);

    header("Location: /Edupath/views/BackOffice/GestionForum/forumAdmin.php?page=reponses");
}