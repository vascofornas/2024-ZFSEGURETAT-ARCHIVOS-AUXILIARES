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

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Variables
    $filePath = $_POST['filePath'];
    $emails = isset($_POST['emails']) ? $_POST['emails'] : [];

    if (!empty($filePath) && !empty($emails) && file_exists($filePath)) {
        // Obtener el nombre del archivo
        $fileName = basename($filePath);

        if (!$fileName) {
            echo "Error: El nombre del archivo no se pudo determinar.";
            exit;
        }

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

            // Establecer codificación UTF-8
            $mail->CharSet = 'UTF-8';

            // Remitente
            $mail->setFrom('info@zfseguretat.es', 'ZF Seguretat'); // Dirección y nombre del remitente

            // Contenido del correo
            $subject = "Envio de informe: " . $fileName;
            $body = "Adjunto encontrarás el archivo PDF del informe: " . $fileName;
            $mail->isHTML(true); // Establecer formato HTML
            $mail->Subject = $subject; // Asunto del correo
            $mail->Body = $body; // Cuerpo del correo

            // Adjuntar archivo PDF
            $pdf_content = file_get_contents($filePath); // Obtener contenido del archivo PDF
            if ($pdf_content === false) {
                throw new Exception("Error al leer el archivo PDF.");
            }
            $mail->addStringAttachment($pdf_content, $fileName, 'base64', 'application/pdf');

            // Enviar correo a cada destinatario
            foreach ($emails as $email) {
                if ($email) { // Validar email antes de agregarlo
                    $mail->addAddress($email); // Agregar destinatario
                    $mail->send(); // Enviar correo
                    $mail->clearAddresses(); // Limpiar destinatarios para el siguiente ciclo
                }
            }
            echo 'Correos enviados exitosamente';
        } catch (Exception $e) {
            echo "Error al enviar el correo: " . htmlspecialchars($mail->ErrorInfo);
        }
    } else {
        if (empty($filePath)) {
            echo "Error: No se proporcionó el archivo.";
        } elseif (empty($emails)) {
            echo "Error: No se proporcionó una lista de correos.";
        } elseif (!file_exists($filePath)) {
            echo "Error: El archivo no existe.";
        } else {
            echo "Error desconocido.";
        }
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
