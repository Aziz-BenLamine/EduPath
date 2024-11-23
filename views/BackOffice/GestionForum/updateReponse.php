<?php

include_once "/xampp/htdocs/EduPath/controllers/reponseC.php";
$reponseC = new reponseC();

$_POST['id'] = $_GET['id'];

$reponseC->updateReponse($_POST);

header("Location: /Edupath/views/BackOffice/GestionForum/forumAdmin.php?page=reponses");
exit();