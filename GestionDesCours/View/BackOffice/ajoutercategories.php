<?php
include_once '/xampp/htdocs/EduPath/GestionDesCours\Controller\categoriescontroller.php';


$categoriesController = new CategoriesController();


$categorie = new Categorie(
    1,
    $_POST['categoryTitle'],
    $_POST['categoryDescription']
);
$titre = $_POST['categoryTitle'];
var_dump($categorie);
$categoriesController->ajoutercategories($categorie);

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
    $mail->Subject = 'New Category Added';
    $mail->Body    = "Dear Teacher,<br><br>A new category named $titre is added<br><br>Don't forget to check it!";
    $mail->AltBody = "Dear Teacher,<br><br>A new category named $titre is added<br><br>Don't forget to check it!";

    $mail->send();
    echo 'A confirmation email has been sent.';
} catch (Exception $e) {
    echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
}

header('location: indexadmin.php');
