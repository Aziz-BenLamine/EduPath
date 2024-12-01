<?php

require '../quizznourane/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

try {
    // Database connection
    require 'C:\xampp\htdocs\dashboard\quizznourane\config.php';
    $pdo = Config::getConnexion();

    // Fetch quiz data
    $sqlQuiz = "SELECT * FROM quiz";
    $stmtQuiz = $pdo->prepare($sqlQuiz);
    if (!$stmtQuiz->execute()) {
        die("Database query failed: " . implode(", ", $stmtQuiz->errorInfo()));
    }

    $quizzes = $stmtQuiz->fetchAll(PDO::FETCH_ASSOC);
    if (empty($quizzes)) {
        die("No data found in the 'quiz' table.");
    }

    // Fetch questions for each quiz
    $sqlQuestions = "SELECT * FROM question WHERE id_quiz = :id_quiz";
    $stmtQuestions = $pdo->prepare($sqlQuestions);

    // Configure Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Build HTML content
    $html = <<<HTML
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <h1>Quiz Details</h1>
    HTML;

    foreach ($quizzes as $quiz) {
        $html .= <<<HTML
        <h2>Quiz: {$quiz['titre']}</h2>
        <p>Description: {$quiz['description']}</p>
        <p>Category: {$quiz['categorie']}</p>
        <table>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Type</th>
            </tr>
        HTML;

        // Fetch and append questions for the current quiz
        $stmtQuestions->execute(['id_quiz' => $quiz['id']]);
        $questions = $stmtQuestions->fetchAll(PDO::FETCH_ASSOC);

        foreach ($questions as $question) {
            $html .= <<<HTML
            <tr>
                <td>{$question['idq']}</td>
                <td>{$question['question']}</td>
                <td>{$question['typeq']}</td>
            </tr>
            HTML;
        }

        $html .= '</table>';
    }

    // Debug generated HTML (optional)
    // echo $html; exit;

    // Load HTML and render PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Clean output buffer and stream PDF
    ob_end_clean();
    $dompdf->stream("quizzes_file", array('Attachment' => 0));

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
} catch (Exception $e) {
    die("General Error: " . $e->getMessage());
}
?>
