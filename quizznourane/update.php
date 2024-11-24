<?php
include('..\quizznourane\model\quizModel.php'); // Adjust path based on the folder structure
include('..\quizznourane\controleur\quizControler.php');




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idq = $_POST['idq'];
    $questionText = $_POST['question'];
    $typeq = $_POST['typeq'];

    // Create a Question object
    $question = new Question();
    $question->setIdq($idq);
    $question->setQuestion($questionText);
    $question->setTypeq($typeq);


    $quizController = new quizs();
    $quizController->updatequestion($question, $idq);

    // Redirect back to the questions list after update
    header("Location: back.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
