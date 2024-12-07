<?php
include('..\quizznourane\model\quizModel.php'); // Adjust path based on the folder structure
include('..\quizznourane\controleur\quizControler.php');




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch data from POST request
    $idq = $_POST['idq'];
    $questionText = $_POST['question'];
    $typeq = $_POST['typeq'];
    $id_quiz = $_POST['id_quiz']; // New attribute
    $numR = $_POST['numR'];       // New attribute

    // Create a Question object
    $question = new Question();
    $question->setIdq($idq);
    $question->setQuestion($questionText);
    $question->setTypeq($typeq);
    $question->setId_quiz($id_quiz); // Set the new attribute
    $question->setNumR($numR);       // Set the new attribute

    // Update the question using the controller
    $quizController = new quizs();
    $quizController->updatequestion($question, $idq);

    // Redirect back to the questions list after update
    header("Location: sidebar.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}

