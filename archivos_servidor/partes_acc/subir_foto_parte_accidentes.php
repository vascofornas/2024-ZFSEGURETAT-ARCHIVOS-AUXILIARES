<?php
// Habilitar la visualización de errores (para desarrollo, deshabilitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar que los datos POST existan
if (isset($_POST['image']) && isset($_POST['name'])) {
    $image = $_POST['image'];
    $name = $_POST['name'];

    // Decodificar la imagen base64
    $realImage = base64_decode($image);

    // Verificar que la decodificación fue exitosa
    if ($realImage === false) {
        echo "Error al decodificar la imagen";
        exit;
    }

    // Guardar la imagen en el archivo
    if (file_put_contents($name, $realImage) === false) {
        echo "Error al guardar la imagen";
        exit;
    }

    echo "OK";
} else {
    echo "Datos POST incompletos";
}
?>
