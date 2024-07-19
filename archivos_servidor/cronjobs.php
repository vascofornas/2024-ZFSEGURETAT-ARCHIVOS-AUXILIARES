<?php
// Lista de URLs de los scripts PHP remotos
$urls = [
    "https://zfseguretat.es/backup.php",
    "https://zfseguretat.es/backups_sin_comprimir.php",
    "https://zfseguretat.es/borrar_backups_10_dias.php",
    "https://zfseguretat.es/borrar_backups_sin_comprimir_10_dias.php",
    
];

// Función para ejecutar una solicitud HTTP a una URL
function executeUrl($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300); // Aumentar el tiempo de espera si es necesario
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode;
}

// Iterar sobre cada URL y hacer una solicitud HTTP secuencialmente
foreach ($urls as $url) {
    echo "Ejecutando: $url\n";
    $httpCode = executeUrl($url);
    if ($httpCode == 200) {
        echo "Ejecución exitosa: $url\n";
    } else {
        echo "Error al ejecutar: $url\n";
    }
    // Esperar antes de ejecutar el siguiente script (opcional)
    // sleep(10); // Espera 10 segundos antes de la siguiente solicitud, ajusta según sea necesario
}
?>
