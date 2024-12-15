<?php

include_once "/xampp/htdocs/EduPath/controllers/reponseC.php";
$reponseC = new reponseC();

$_POST['id'] = $_GET['id'];

$reponseC->updateReponse($_POST);
$id_publication = $reponseC->getPublicationId($_GET['id']);
echo $id_publication['publication'];
header("Location: /Edupath/views/reponses/reponsesView.php?id=" . $id_publication['publication']);
exit();
