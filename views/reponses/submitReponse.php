<?php
require_once "/xampp/htdocs/EduPath/controllers/reponseC.php";
require_once "/xampp/htdocs/EduPath/models/reponse.php";


if ($_SERVER['REQUEST_METHOD'] = 'POST'){
    $contenu = $_POST['response'];
    $date_creation = date("Y-m-d H:i:s");
    $cree_par = "1";
    $publication = $_GET['id_publication'];
    $reponse = new reponse(null, $contenu, $date_creation, $cree_par, $publication);
    $reponseC = new reponseC();
    $reponseC->addReponse([
        'contenu' => $reponse->getContenu(),
        'date_creation' => $reponse->getDateCreation(),
        'cree_par' => $reponse->getCreePar(),
        'publication' => $reponse->getPublicationId()
    ]);
    header("Location: /EduPath/views/reponses/reponsesView.php?id=$publication");
    exit();
}


?>