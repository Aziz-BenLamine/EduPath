<?php
include_once '../../Controller/categoriescontroller.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$CategoriesController = new CategoriesController();
$Categorie = $CategoriesController->getCategoriesById($_GET['id']);
$titre=$Categorie['titre'];
if (isset($_GET['id'])){
$id = $_GET['id'];
$CategoriesController->supprimercategories($id);


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
    $mail->Subject = 'A Category has been deleted';
    $mail->Body    = "Dear Teacher,<br><br>The category $titre has been deleted, if you have any courses in this category they'll be deleted<br><br>Please check if there's any other category you can add your courses in.<br><br>We're sorry!";
    $mail->AltBody = "Dear Teacher,<br><br>The category $titre has been deleted, if you have any courses in this category they'll be deleted<br><br>Please check if there's any other category you can add your courses in.<br><br>We're sorry!";

    $mail->send();
    echo 'A confirmation email has been sent.';
} catch (Exception $e) {
    echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
}
header('Location: indexadmin.php');
}
else{
    echo "Erreur";
}