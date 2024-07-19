<?php
// Habilitar la visualización de errores para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar las clases de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Variables
$recipient = 'modestovasco@gmail.com';
$pdf_url = 'pdf/pdf/Diario - Patrulla 2 - Turno Tarde - 12-07-2024.pdf'; // Ruta al archivo PDF local
$subject = "Aquí está tu archivo PDF";
$body = "Adjunto encontrarás el archivo PDF.";

// Configuración de PHPMailer
$mail = new PHPMailer(true); // Habilitar excepciones
try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'zfseguretat.es';  // Cambiar al servidor SMTP que uses
    $mail->SMTPAuth = true;
    $mail->Username = 'info@zfseguretat.es'; // Cambiar al usuario SMTP
    $mail->Password = 'Awp4w548_'; // Cambiar a la contraseña SMTP
    $mail->SMTPSecure = 'ssl'; // Usar 'ssl' o 'tls' según la configuración del servidor
    $mail->Port = 465; // Puerto SMTP - 587 para TLS, 465 para SSL

    // Destinatario y remitente
    $mail->setFrom('info@zfseguretat.es', 'ZF Seguretat'); // Dirección y nombre del remitente
    $mail->addAddress($recipient); // Agregar destinatario

    // Contenido del correo
    $mail->isHTML(true); // Establecer formato HTML
    $mail->Subject = $subject; // Asunto del correo
    $mail->Body = $body; // Cuerpo del correo

    // Adjuntar archivo PDF
    $pdf_content = file_get_contents($pdf_url); // Obtener contenido del archivo PDF
    $mail->addStringAttachment($pdf_content, 'Diario - Patrulla 2 - Turno Tarde - 12-07-2024.pdf', 'base64', 'application/pdf');

    // Enviar correo
    $mail->send();
    echo 'Correo enviado exitosamente';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
