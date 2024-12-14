<?php

include('..\quizznourane\controleur\quizControler.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idq = $_POST['idq'];

    $quizController = new quizs();
    $quizController->deletequestion($idq);

    header("Location: sidebar.php");
    exit;
}
?>
