<?php

include_once "/xampp/htdocs/EduPath/controllers/reponseC.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $reponseC = new reponseC();
    $id_publication = $reponseC->getPublicationId($id);
    $reponseC->deleteReponse($id);

    header("Location: /Edupath/views/reponses/reponsesView.php?id=" . $id_publication['publication']);
}
