<?php
// Ruta de la carpeta donde se encuentra este archivo PHP
$rutaActual = dirname(__FILE__);

// Ruta completa de la carpeta de backups
$carpetaBackups = $rutaActual . '/backups';

// Obtener la lista de archivos en la carpeta de backups
$archivos = scandir($carpetaBackups);

// Fecha actual en formato Unix (segundos desde Unix Epoch)
$fechaActual = time();

// Definir el número de días de antigüedad permitidos
$diasAntiguedad = 10;

// Calcular el tiempo máximo en segundos
$tiempoMaximo = $diasAntiguedad * 24 * 60 * 60; // Convertir días a segundos

// Contador de archivos eliminados
$archivosEliminados = 0;

// Iterar sobre los archivos en la carpeta de backups
foreach ($archivos as $archivo) {
    // Construir la ruta completa del archivo
    $rutaArchivo = $carpetaBackups . '/' . $archivo;

    // Verificar si es un archivo y si tiene más de x días de antigüedad
    if (is_file($rutaArchivo) && ($fechaActual - filemtime($rutaArchivo)) > $tiempoMaximo) {
        // Intentar eliminar el archivo
        if (unlink($rutaArchivo)) {
            echo 'Archivo eliminado: ' . $archivo . "\n";
            $archivosEliminados++;
        } else {
            echo 'No se pudo eliminar el archivo: ' . $archivo . "\n";
        }
    }
}

// Contar los archivos restantes en la carpeta de backups
$numArchivos = count($archivos) - 2; // Restar '.' y '..'

// Mostrar mensaje si no se encontraron archivos para eliminar
if ($archivosEliminados === 0) {
    echo "No se encontraron archivos para eliminar.\n";
}

// Mostrar el número total de archivos en la carpeta de backups
echo "Total archivos en la carpeta 'backups': {$numArchivos}\n";
?>

