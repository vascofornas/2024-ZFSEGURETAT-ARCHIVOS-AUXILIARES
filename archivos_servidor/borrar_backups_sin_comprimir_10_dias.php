<?php
// Ruta de la carpeta donde se encuentra este archivo PHP
$rutaActual = dirname(__FILE__);

// Ruta completa de la carpeta de backups sin comprimir
$carpetaBackups = $rutaActual . '/backups_sin_comprimir';

// Obtener la lista de carpetas en la carpeta de backups sin comprimir
$carpetas = scandir($carpetaBackups);

// Fecha actual en formato Unix (segundos desde Unix Epoch)
$fechaActual = time();

// Definir el número de días de antigüedad permitidos
$diasAntiguedad = 10;

// Calcular el tiempo máximo en segundos
$tiempoMaximo = $diasAntiguedad * 24 * 60 * 60; // Convertir días a segundos

// Contadores
$carpetasEliminadas = 0;
$totalCarpetas = 0;

// Iterar sobre las carpetas en la carpeta de backups sin comprimir
foreach ($carpetas as $carpeta) {
    // Excluir los elementos especiales . y ..
    if ($carpeta === '.' || $carpeta === '..') {
        continue;
    }

    // Construir la ruta completa de la carpeta
    $rutaCarpeta = $carpetaBackups . '/' . $carpeta;

    // Verificar si es una carpeta y si tiene más de x días de antigüedad
    if (is_dir($rutaCarpeta) && ($fechaActual - filemtime($rutaCarpeta)) > $tiempoMaximo) {
        // Función para eliminar carpeta recursivamente
        function eliminarCarpeta($rutaCarpeta)
        {
            $archivos = glob($rutaCarpeta . '/*');
            foreach ($archivos as $archivo) {
                is_dir($archivo) ? eliminarCarpeta($archivo) : unlink($archivo);
            }
            rmdir($rutaCarpeta);
        }

        // Intentar eliminar la carpeta
        try {
            eliminarCarpeta($rutaCarpeta);
            echo 'Carpeta eliminada: ' . $carpeta . "\n";
            $carpetasEliminadas++;
        } catch (Exception $e) {
            echo 'No se pudo eliminar la carpeta: ' . $carpeta . "\n";
        }
    }

    $totalCarpetas++;
}

// Mostrar resultados finales
if ($carpetasEliminadas > 0) {
    echo "Se eliminaron $carpetasEliminadas carpetas.\n";
} else {
    echo "No había carpetas para eliminar.\n";
}

// Restar 2 al total de carpetas solo si hay más de 2 carpetas (excluyendo . y ..)
if ($totalCarpetas > 2) {
    $totalCarpetas -= 2;
}

echo "Total de carpetas encontradas: $totalCarpetas\n";
?>
