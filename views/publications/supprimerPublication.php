<?php

include_once "/xampp/htdocs/EduPath/controllers/publicationC.php";
$publicationC = new publicationC();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $publicationC->deletePublication($id);

    header("Location: /Edupath/views/publications/publicationsView.php?id=" . $_GET['id_sujet']);
}