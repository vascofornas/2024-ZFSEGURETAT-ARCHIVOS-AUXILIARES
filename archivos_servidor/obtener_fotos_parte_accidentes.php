<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Definir ruta absoluta para el archivo de registro
$log_file = __DIR__ . '/errores.txt';

# Función para registrar errores en un archivo
function log_error($message) {
    global $log_file;
    if (is_writable(dirname($log_file))) {
        file_put_contents($log_file, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
    } else {
        error_log("El directorio no es escribible: " . dirname($log_file));
    }
}

# Salir si el método no es POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    log_error("Método HTTP incorrecto");
    http_response_code(405); // Método no permitido
    echo json_encode(["success" => false, "message" => "Método HTTP incorrecto"]);
    exit();
}

# Salir si alguno de los datos no está presente
if (!isset($_POST["codigoparte"])) {
    log_error("Datos incompletos: codigoparte no está presente");
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit();
}

# Incluir archivo de conexión mysqli
include_once "connect.php"; // Asegúrate de tener este archivo y que establezca $con

try {
    # Preparar la consulta SQL
    $codigoparte = $_POST["codigoparte"];
    $stmt = $con->prepare("SELECT archivo FROM tb_fotos_partes_accidentes WHERE codigo = ?");
    $stmt->bind_param("s", $codigoparte);
    $stmt->execute();
    $result = $stmt->get_result();

    # Obtener resultados
    $respuesta = [];
    while ($row = $result->fetch_assoc()) {
        $respuesta[] = $row['archivo'];
    }

    echo json_encode($respuesta);
} catch (Exception $e) {
    log_error("Error al ejecutar la consulta SQL: " . $e->getMessage());
    http_response_code(500); // Error interno del servidor
    echo json_encode(["success" => false, "message" => "Error al ejecutar la consulta SQL"]);
}
?>
