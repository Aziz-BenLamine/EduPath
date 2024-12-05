<?php
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
$userEmail = "aymen.fredj@esprit.tn";
$subject = "Payment Confirmation";
$message = "Dear user,\n\nYour payment for course ID $courseId has been successfully processed.\n\nThank you!";
$headers = "From: no-reply@example.com";

if (mail($userEmail, $subject, $message, $headers)) {
    echo " A confirmation email has been sent.";
} else {
    echo "Failed to send confirmation email.";
}
?>

