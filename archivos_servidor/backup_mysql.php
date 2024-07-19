<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'PHPMailer/vendor/autoload.php'; // Asegúrate de que esta línea apunte a tu autoload.php de Composer

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'zfbarcelona_zfseguretat';
$username = 'zfseguretat';
$password = 'g9hr#+-_awnoA';

// Configuración del correo electrónico
$to = 'info@zfseguretat.es';
$subject = 'Copia de seguridad de la base de datos ZFSeguretat';
$message = 'Adjunto encontrarás la copia de seguridad de la base de datos.';
$from = 'info@zfseguretat.es';
$fromName = 'ZF Seguretat';

// Nombre del archivo de la copia de seguridad
$backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

// Comando para realizar la copia de seguridad
$command = "mysqldump --host=$host --user=$username --password='$password' $dbname > $backupFile";

// Ejecutar el comando y capturar la salida y el estado
exec($command, $output, $return_var);

// Verificar si el archivo de la copia de seguridad fue creado
if ($return_var === 0 && file_exists($backupFile) && filesize($backupFile) > 0) {
    echo "Copia de seguridad creada exitosamente: $backupFile\n";

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'zfseguretat.es'; // Cambia esto por el host de tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'info@zfseguretat.es'; // Cambia esto por tu usuario SMTP
        $mail->Password = '7E4!1brl0'; // Cambia esto por tu contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SMTPS para el puerto 465
        $mail->Port = 465;

        // Remitente y destinatarios
        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Adjuntar el archivo de la copia de seguridad
        $mail->addAttachment($backupFile);

        // Enviar el correo
        $mail->send();
        echo 'Copia de seguridad realizada y enviada por correo electrónico correctamente.';
    } catch (Exception $e) {
        echo "No se pudo enviar el correo electrónico. Error de PHPMailer: {$mail->ErrorInfo}";
    }
} else {
    echo "No se pudo crear la copia de seguridad. Error: " . implode("\n", $output) . " Código de retorno: $return_var";
}
?>
