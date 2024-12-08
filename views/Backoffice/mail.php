<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../pdf/fpdf.php';

require '../../PHPMailer-PHPMailer-1a06bd3/src/Exception.php';
require '../../PHPMailer-PHPMailer-1a06bd3/src/PHPMailer.php';
require '../../PHPMailer-PHPMailer-1a06bd3/src/SMTP.php';

function envoyerEmail($destinataire, $nom, $sujet, $contenu) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Remplacer par votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'hamoudahajji524@gmail.com'; // Remplacer par votre email
        $mail->Password = 'hdyg caez sbvr fgls'; // Remplacer par votre mot de passe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Destinataires
        $mail->setFrom('hamoudahajji524@gmail.com', 'Admin EduPath');
        $mail->addAddress($destinataire, $nom);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Réponse à votre réclamation : ' . $sujet;
        
        // Corps du message
        $messageHtml = "
        <html>
        <body style='font-family: Arial, sans-serif;'>
            <h2 style='color: #0056b3;'>Bonjour $nom,</h2>
            <p>Nous avons traité votre réclamation concernant : <strong>$sujet</strong></p>
            <p>Voici notre réponse :</p>
            <div style='background-color: #f5f5f5; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                $contenu
            </div>
            <p>Cordialement,<br>L'équipe EduPath</p>
        </body>
        </html>";

        $mail->Body = $messageHtml;
        $mail->AltBody = strip_tags($messageHtml);
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode ('Réponse à votre réclamation'), 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 10, utf8_decode("Bonjour $nom,\n\nNous avons traité votre réclamation concernant : $sujet\n\nVoici notre réponse :\n\n$contenu\n\nCordialement,\nL'équipe EduPath"));

        // Sauvegarder le PDF dans un fichier temporaire
        $filePath = sys_get_temp_dir() . '/reponse_reclamation.pdf';
        $pdf->Output('F', $filePath);

        // Attacher le PDF à l'email
        $mail->addAttachment($filePath, 'reponse_reclamation.pdf');

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "L'email n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
    }
}
?>