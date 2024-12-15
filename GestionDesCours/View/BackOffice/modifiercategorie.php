<?php
include_once '/xampp/htdocs/EduPath/GestionDesCours\Controller\categoriescontroller.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$categoryController = new CategoriesController();
$Categorie = $categoryController->getCategoriesById($_POST['id']);
$tit = $Categorie['titre'];
$desc = $Categorie['description'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    $category = new Categorie($id, $titre, $description);
    $category->setTitre($titre);
    $category->setDescription($description);

    $categoryController->modifiercategories($category, $id);
}


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
    $mail->Subject = 'A Category has been updated';
    $mail->Body    = "Dear Teacher,<br><br>The category $tit has been updated.<br><br>The changes are:<br><br>$tit=> $titre<br><br>$desc=> $description<br><br>Don't forget to check it!";
    $mail->AltBody = "Dear Teacher,<br><br>The category $tit has been updated.<br><br>The changes are:<br><br>$tit=> $titre<br><br>$desc=> $description<br><br>Don't forget to check it!";

    $mail->send();
    echo 'A confirmation email has been sent.';
} catch (Exception $e) {
    echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
}

header('Location: indexadmin.php');
