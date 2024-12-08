<?php
require_once '../../Controller/courscontroller.php';
require_once '../../Controller/categoriescontroller.php';


    $cours= new Cours(
        1,
        $_POST['courseTitle'],
        $_POST['courseDescription'],
        $_POST['courseLevel'],
        $_POST['coursePrice'],
        $_POST['courseCategory']
    );
    $categoriesController = new CategoriesController();
    $courseController = new CoursController();
    $courseController->ajoutercours($cours);
    $categorie=$categoriesController->getCategoriesById($_POST['courseCategory']);
    $titre=$_POST['courseTitle'];
    $cat=$categorie['titre'];
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
    $mail->Subject = 'New Course Added';
    $mail->Body    = "Dear Student,<br><br>A new course named $titre is added in the category $cat<br><br>Don't forget to check it!";
    $mail->AltBody = "Dear Student,<br><br>A new course named $titre is added in the category $cat<br><br>Don't forget to check it!";

    $mail->send();
    echo 'A confirmation email has been sent.';
} catch (Exception $e) {
    echo "Failed to send confirmation email. Mailer Error: {$mail->ErrorInfo}";
}
    header('Location: courstuteur.php?id='.$_POST['courseCategory']);
?>
