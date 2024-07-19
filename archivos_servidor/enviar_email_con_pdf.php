<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = $_POST['recipient'];
    $pdf_url = $_POST['pdf_url'];

    $subject = "Aquí está tu archivo PDF";
    $body = "Adjunto encontrarás el archivo PDF.";
    $headers = "From: sender@example.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Download the PDF
    $pdf_content = file_get_contents($pdf_url);
    $attachment = chunk_split(base64_encode($pdf_content));

    $separator = md5(time());
    $eol = "\r\n";

    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    $message = "--" . $separator . $eol;
    $message .= "Content-Type: text/html; charset=\"UTF-8\"" . $eol;
    $message .= "Content-Transfer-Encoding: 8bit" . $eol;
    $message .= $body . $eol;

    $message .= "--" . $separator . $eol;
    $message .= "Content-Type: application/octet-stream; name=\"file.pdf\"" . $eol;
    $message .= "Content-Transfer-Encoding: base64" . $eol;
    $message .= "Content-Disposition: attachment" . $eol;
    $message .= $attachment . $eol;
    $message .= "--" . $separator . "--";

    if (mail($recipient, $subject, $message, $headers)) {
        echo "Correo enviado exitosamente";
    } else {
        echo "Error al enviar el correo";
    }
} else {
    echo "Método no permitido";
}
?>
