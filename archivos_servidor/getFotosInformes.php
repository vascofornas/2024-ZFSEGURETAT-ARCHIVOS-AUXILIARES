<?php

header("Access-Control-Allow-Origin: *");
$servername = "localhost";
$username = "zfseguretat";
$password = "g9hr#+-_awnoA";
$dbname = "zfbarcelona_zfseguretat";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    // Obtener el valor de 'codigo' enviado desde Flutter
    $codigo = $_GET['codigo'];

    // Consultar la base de datos
    $query = "SELECT id, codigo, archivo FROM tb_fotos_informes_incidencias WHERE codigo = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param('s', $codigo);

    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    // Obtener resultados
    $resultado = $stmt->get_result();
    $data = array();

    while ($row = $resultado->fetch_assoc()) {
        $data[] = $row;
    }

    // Enviar resultados como JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (Exception $e) {
    // Manejar excepciones
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    // Cerrar la conexión de manera segura
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>
