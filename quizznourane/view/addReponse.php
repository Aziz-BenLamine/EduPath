<?php
include __DIR__ . '/../model/quizModel.php';
include __DIR__ . '/../controleur/quizControler.php';

$id_question = isset($_GET['idq']) ? htmlspecialchars($_GET['idq']) : null;
if (isset($_GET['idq'])) {
    echo 'ID Question: ' . htmlspecialchars($_GET['idq']);
} else {
    echo 'ID Question is missing or invalid.';
}
   
if ($id_question) {
    // Get the maximum allowed responses for this question
    $numR = $questionController->getNumRForQuestion($id_question);

    // Get the current number of responses for this question
    $responseCount = $questionController->getResponseCountForQuestion($id_question);

    // Check if the number of responses is less than the allowed maximum
    if ($responseCount < $numR) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get the form data
            $reponseText = $_POST['reponse'];
            $score = $_POST['score'];
            $correction = $_POST['correction'];

            // Create a new response object
            $reponse = new Reponse();
            $reponse->setReponseText($reponseText);
            $reponse->setScore($score);
            $reponse->setCorrection($correction);
            $reponse->setId_question($id_question);

            // Add the new response
            $quizController = new quizs();
            $result = $quizController->addReponse($reponse);

            // Redirect after adding the response
            header('Location: index.php');
            exit;
        }
    } else {
        // If the response limit is reached, show an error
        $error = "You have reached the maximum number of responses for this question.";
        echo "<p style='color: red; text-align: center;'>$error</p>";
    }
} else {
    // If no question ID is provided, show an error
    echo "<p style='color: red; text-align: center;'>Invalid or missing question ID.</p>";
}
?>
