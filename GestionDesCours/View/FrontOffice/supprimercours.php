<?php
require_once '../../Controller/courscontroller.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$courseController = new CoursController();
if(isset($_GET['user'])){
    $user=$_GET['user'];
}
else{
    $user=1111111111;
}


$cours=$courseController->getCoursById($_GET['id']);
$titre=$cours['titre'];
if (isset($_GET['id'])){
$id = $_GET['id'];
$courseController->supprimercours($id);
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
    $mail->Subject = 'A Course has been deleted';
    $mail->Body    = "Dear Student,<br><br>The course $titre has been deleted.<br><br>We're sorry!";
    $mail->AltBody = "Dear Student,<br><br>The course $titre has been deleted.<br><br>We're sorry!";

    $mail->send();
    echo 'A confirmation email has been sent.';
} catch (Exception $e) {
    echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
}
header('Location: courstuteur.php?id=' . $cours['categorie'].'&user='. $user);
}
else{
    echo "Erreur";
}