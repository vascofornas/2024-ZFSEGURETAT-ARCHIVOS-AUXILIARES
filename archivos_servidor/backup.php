<?php
// Mostrar todos los errores de PHP para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establecer un tiempo de ejecución ilimitado para evitar interrupciones
set_time_limit(0);

echo "Inicio del script...\n";

// Ruta del directorio raíz que deseas respaldar (ajústala según tu configuración)
$ruta_raiz = __DIR__;

// Carpeta donde se almacenarán los backups (excluir esta carpeta del backup)
$carpeta_backups = $ruta_raiz . '/backups';

// Asegurarse de que la carpeta de backups exista
if (!is_dir($carpeta_backups)) {
    if (!mkdir($carpeta_backups, 0777, true)) {
        die('Error al crear la carpeta de backups');
    } else {
        echo "Carpeta de backups creada.\n";
    }
} else {
    echo "Carpeta de backups ya existe.\n";
}

// Nombre del archivo de backup con un formato específico
$backupFile = $carpeta_backups . '/backup_' . date('Y-m-d_H-i-s') . '.zip';

// Función para agregar archivos y carpetas al archivo ZIP recursivamente
function agregarArchivosAlZip($ruta, $zip, $carpeta_excluir) {
    echo "Agregando archivos al ZIP...\n";
    $archivos = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($ruta),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($archivos as $archivo) {
        try {
            // Omitir directorios y la carpeta de backups
            if (!$archivo->isDir() && strpos($archivo->getPathname(), $carpeta_excluir) === false) {
                // Obtener el camino relativo
                $caminorelativo = substr($archivo->getPathname(), strlen($ruta) + 1);

                // Añadir el archivo al ZIP
                if ($zip->addFile($archivo->getPathname(), $caminorelativo)) {
                    echo "Archivo agregado: " . $archivo->getPathname() . " como " . $caminorelativo . "\n";
                } else {
                    throw new Exception('Error al agregar el archivo: ' . $archivo->getPathname());
                }
            }
        } catch (Exception $e) {
            echo 'Excepción capturada: ' . $e->getMessage() . "\n";
        }
    }
}

// Comprimir archivos en un archivo ZIP
$zip = new ZipArchive();
if ($zip->open($backupFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    echo "Archivo ZIP creado: " . $backupFile . "\n";
    agregarArchivosAlZip($ruta_raiz, $zip, $carpeta_backups);
    $zip->close();
    echo 'Backup creado: ' . basename($backupFile) . "\n"; // Mostrar solo el nombre del archivo de backup creado
} else {
    die('Error al crear el archivo ZIP');
}

echo "Fin del script...\n";
?>



 