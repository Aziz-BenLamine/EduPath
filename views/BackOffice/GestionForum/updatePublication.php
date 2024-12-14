<?php

include_once "/xampp/htdocs/EduPath/controllers/publicationC.php";
$publicationC = new publicationC();

$_POST['id'] = $_GET['id'];

$publicationC->updatePublication($_POST);

header("Location: /Edupath/views/BackOffice/forumAdmin.php");
exit();