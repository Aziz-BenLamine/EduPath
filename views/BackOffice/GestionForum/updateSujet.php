<?php

include_once "/xampp/htdocs/EduPath/controllers/sujetForumC.php";
$sujetForumC = new sujetForumC();

$_POST['id'] = $_GET['id'];

$sujetForumC->updateSujet($_POST);

header("Location: /Edupath/views/BackOffice/GestionForum/forumAdmin.php?page=sujets");
exit();