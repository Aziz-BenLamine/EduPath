<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require '../quizznourane/PHPMailer.php';
require '../quizznourane/SMTP.php';
require '../quizznourane/Exception.php';

// Check if the form is submitted
if (isset($_POST['send'])) {
    // Retrieve form data
    $email = $_POST['adresse']; // Recipient's email
    $subject = $_POST['subject']; // Email subject
    $message = $_POST['message']; // Email body

    $mail = new PHPMailer(true);

    try {
        // Enable verbose debug output
        $mail->SMTPDebug = 0; // Change to 2 for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Landoulsinourane@gmail.com'; // Replace with your Gmail email
        $mail->Password = 'wiam zzjp sbyy kwdf';   // Replace with your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set sender and recipient
        $mail->setFrom('Landoulsinourane@gmail.com', 'Nourane');
        $mail->addAddress($email); // Add recipient from form input

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject; // Use subject from form
        $mail->Body    = nl2br($message); // Convert newlines to <br> for HTML format

        // Send email
        $mail->send();

        // Success message
        echo '<div style="background-color: #4CAF50; color: #fff; padding: 15px; text-align: center;">';
        echo '<h2>Mail sent successfully 🚀</h2>';
        echo '<a href="sidebar.php"><button style="background-color: #008CBA; color: #fff; padding: 10px 20px; cursor: pointer; border: none; border-radius: 5px;">Get Back</button></a>';
        echo '</div>';
    } catch (Exception $e) {
        echo '<div style="background-color: #f44336; color: #fff; padding: 15px; text-align: center;">';
        echo '<h2>Mailer Error: ' . $mail->ErrorInfo . '</h2>';
        echo '<a href="/dashboard/recettenadine/view/Back/pages/form.php"><button style="background-color: #555; color: #fff; padding: 10px 20px; cursor: pointer; border: none; border-radius: 5px;">Try Again</button></a>';
        echo '</div>';
    }
}
?>
