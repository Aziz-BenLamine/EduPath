<?php
require_once '../../controller/courscontroller.php';
require_once '/xampp/htdocs/EduPath/controllers/UserController.php';
require_once __DIR__ . '/../../config.php';

$conn = config::getConnexion();
session_start();
$id_user = $_SESSION['id'];
$user_controller = new UserController($conn);
$et = $user_controller->getUserById($id_user);

$courscontroller = new CoursController();
$id = $_GET['id'];
$cours = $courscontroller->getCoursById($_POST['course_id']);
$titre = $cours['titre'];
$prix = $cours['prix'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseId = $_POST['course_id'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['card_expiry'];
    $cvv = $_POST['card_cvc'];

    // Validate form data
    if (empty($courseId) || empty($cardNumber) || empty($expiryDate) || empty($cvv)) {
        echo "All fields are required.";
        exit;
    }

    // Process payment (dummy processing for example purposes)
    $isPaymentSuccessful = processPayment($cardNumber, $expiryDate, $cvv);

    if ($isPaymentSuccessful) {
        echo "Payment successful!";
    } else {
        echo "Payment failed. Please try again.";
    }
}

function processPayment($cardNumber, $expiryDate, $cvv)
{
    // Dummy payment processing logic
    // In real-world scenario, integrate with a payment gateway API
    return true;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;
    $mail->Username   = 'aymenfrej7@gmail.com'; // SMTP username
    $mail->Password   = 'rfve ewrp svms eisc'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('aymenfrej7@gmail.com', 'EduPath');
    $mail->addAddress($et['email']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Payment Confirmation';
    $mail->Body    = "Dear Student,<br><br>Your payment for course $titre has been successfully processed.<br><br>The price: $prix Dt<br><br>Thank you!";
    $mail->AltBody = "Dear Student,<br><br>Your payment for course $titre has been successfully processed.<br><br>The price: $prix Dt<br><br>Thank you!";

    $mail->send();
    echo 'A confirmation email has been sent.';
} catch (Exception $e) {
    echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
}
header("Location: coursetudiant.php?id=$id");
