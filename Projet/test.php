<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

try {
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = "localhost";
    $mail->SMTPAuth = true;
    $mail->Username = "admin@test.com";
    $mail->Password = "Pa$\$w0rd"; // Utiliser une méthode plus sécurisée pour stocker les mots de passe
    $mail->Port = 25;
    $mail->setFrom("admin@test.com", "I Lost It");
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";

    $mail->addAddress("test@gmail.com");
    $mail->Subject = "SalutSalutSalut";
    $mail->Body = "Test mail";

    $mail->send();
    echo "E-mail envoyé avec succès !";
} catch (Exception $e) {
    echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
}
