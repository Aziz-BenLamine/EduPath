<?php
$id=$_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
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

function processPayment($cardNumber, $expiryDate, $cvv) {
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
    $mail->addAddress('aymenfrej1@gmail.com');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Payment Confirmation';
    $mail->Body    = "Dear Student,<br><br>Your payment for course ID $courseId has been successfully processed.<br><br>Thank you!";
    $mail->AltBody = "Dear Student,\n\nYour payment for course ID $courseId has been successfully processed.\n\nThank you!";

    $mail->send();
    echo 'A confirmation email has been sent.';
} catch (Exception $e) {
    echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
}
header("Location: coursetudiant.php?id=$id");
?>

