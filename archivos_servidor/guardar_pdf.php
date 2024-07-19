<?php
// Ruta donde se almacenarán los PDF en el servidor
$uploadDirectory = __DIR__ . '/pdf/';


// Nombre del archivo enviado
$fileName = basename($_FILES['pdf']['name']);

// Ruta completa del archivo de destino
$uploadFilePath = $uploadDirectory . $fileName;

// Mover el archivo temporal a la ubicación de destino
if (move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadFilePath)) {
    echo 'PDF guardado correctamente en el servidor';
} else {
    echo 'Error al guardar el PDF en el servidor';
}
?>
