<?php
// Función para copiar un directorio completo recursivamente
function copyDirectory($src, $dest) {
    // Si el directorio de destino no existe, se crea
    if (!file_exists($dest)) {
        mkdir($dest);
    }

    // Iterar sobre el contenido del directorio fuente
    $dir = opendir($src);
    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            $srcFile = $src . '/' . $file;
            $destFile = $dest . '/' . $file;

            // Si es un directorio, copiar recursivamente
            if (is_dir($srcFile)) {
                // Evitar copiar las carpetas 'backups' y 'backups_sin_comprimir'
                if ($file != 'backups' && $file != 'backups_sin_comprimir') {
                    copyDirectory($srcFile, $destFile);
                }
            } else {
                // Si es un archivo, copiar
                copy($srcFile, $destFile);
            }
        }
    }
    closedir($dir);
}

// Directorio de origen (directorio raíz del sitio web)
$dirSource = __DIR__; // Directorio actual donde se encuentra el script PHP

// Directorio de destino (carpeta donde se copiarán los archivos)
$dirDest = __DIR__ . '/backups_sin_comprimir/backup_' . date('Y-m-d_H-i-s');

// Copiar el directorio fuente al directorio destino
copyDirectory($dirSource, $dirDest);

echo 'Copia de seguridad creada en: ' . $dirDest . "\n";
?>
