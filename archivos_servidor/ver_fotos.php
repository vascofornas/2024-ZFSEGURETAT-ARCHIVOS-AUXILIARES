<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotos de Incidencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .photo {
            margin-bottom: 20px;
        }
        .photo img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Fotos de la Incidencia</h1>
    <?php
    // Configuración de la base de datos
    require_once('appseguridad/flutter_api/connect.php');

    // Verificar conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    // Obtener el código de la incidencia desde el parámetro GET
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';

    if ($codigo) {
        // Consulta SQL para obtener las fotos relacionadas con el código
        $sql = "SELECT archivo FROM tb_fotos_informes_incidencias WHERE codigo = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="photo">';
                echo '<img src="appseguridad/flutter_api/informesincidencias/' . htmlspecialchars($row["archivo"]) . '" alt="Foto de Incidencia">';
                echo '</div>';
            }
        } else {
            echo "<p>No se encontraron fotos para esta incidencia.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Código de incidencia no proporcionado.</p>";
    }

    // Cerrar conexión
    $con->close();
    ?>
</body>
</html>
