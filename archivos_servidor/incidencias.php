<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Incidencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }
        header img {
            max-height: 130px; /* Ajusta el tamaño del logotipo */
            margin-right: 80px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Espacio entre el encabezado y la tabla */
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .filters {
            display: flex;
            gap: 10px;
        }
        .filters form {
            display: inline-block;
        }
        .button-solucionada {
            background-color: orange;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }
        .button-solucion {
            background-color: green;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }
        /* Estilos del modal */
        .modal {
            display: none; /* Ocultar inicialmente */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .descripcion {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <img src="zf.png" alt="Logotipo de ZF">
            <h1>Informe de Incidencias</h1>
        </div>
        <div class="filters">
            <form method="get">
                <button type="submit" name="filter" value="today">Mostrar incidencias de hoy</button>
            </form>
            <form method="get">
                <button type="submit" name="filter" value="last7days">Mostrar incidencias de los últimos 15 días</button>
            </form>
        </div>
    </header>
    <table>
        <thead>
            <tr>
                <th>Fecha de la Incidencia</th>
                <th>Incidencia</th>
                <th>Fotografías</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Configuración de la base de datos
            require_once('appseguridad/flutter_api/connect.php');

            // Verificar conexión
            if ($con->connect_error) {
                die("Conexión fallida: " . $con->connect_error);
            }

            // Función para validar el token
            function validarToken($con, $token) {
                $sql = "SELECT token FROM token_seguridad WHERE token = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("s", $token);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            }

            // Verificar si se envió el formulario POST
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigo']) && isset($_POST['token'])) {
                $codigo = $_POST['codigo'];
                $token = $_POST['token'];

                // Validar el token
                if (validarToken($con, $token)) {
                    // Token válido, actualizar el estado de la incidencia
                    $sql_update = "UPDATE tb_informe_incidencias SET estado = 1 WHERE codigo = ?";
                    $stmt_update = $con->prepare($sql_update);
                    $stmt_update->bind_param("s", $codigo);

                    if ($stmt_update->execute()) {
                        echo "<script>alert('Incidencia marcada como solucionada.');</script>";
                        // Recargar la página para mostrar los cambios
                        echo "<script>window.location.href = 'incidencias.php';</script>";
                    } else {
                        echo "<script>alert('Error al marcar la incidencia como solucionada: " . $con->error . "');</script>";
                    }

                    $stmt_update->close();
                } else {
                    echo "<script>alert('Token no válido.');</script>";
                }
            }

            // Crear consulta SQL según el filtro seleccionado
            $filter = isset($_GET['filter']) ? $_GET['filter'] : 'last7days';

            if ($filter === 'today') {
                $sql = "SELECT fecha_incidencia, codigo, titulo, descripcion, numerofotos, estado
                        FROM tb_informe_incidencias 
                        WHERE DATE(fecha_incidencia) = CURDATE() 
                        ORDER BY fecha_incidencia DESC";
            } else {
                $sql = "SELECT fecha_incidencia, codigo, titulo, descripcion, numerofotos, estado
                        FROM tb_informe_incidencias 
                        WHERE fecha_incidencia >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) 
                        ORDER BY fecha_incidencia DESC";
            }

            $result = $con->query($sql);

            if ($result === false) {
                echo "Error en la consulta: " . $con->error;
            } else if ($result->num_rows > 0) {
                // Mostrar datos de cada fila
                while ($row = $result->fetch_assoc()) {
                    $fechaIncidencia = new DateTime($row["fecha_incidencia"]);
                    $fechaFormateada = $fechaIncidencia->format('d-m-Y H:i\h');
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fechaFormateada) . "</td>";
                    echo "<td>";
                    echo htmlspecialchars($row["titulo"]);
                    echo "<br><span class='descripcion'>" . htmlspecialchars($row["descripcion"]) . "</span>";
                    echo "</td>";
                    echo "<td>";
                    if ($row["numerofotos"] > 0) {
                        echo '<form action="ver_fotos.php" method="get" target="_blank">';
                        echo '<input type="hidden" name="codigo" value="' . htmlspecialchars($row["codigo"]) . '">';
                        echo '<button type="submit">Ver fotos (' . htmlspecialchars($row["numerofotos"]) . ')</button>';
                        echo '</form>';
                    } else {
                        echo htmlspecialchars($row["numerofotos"]);
                    }
                    echo "</td>";
                    echo "<td>";
                    if ($row["estado"] == 0) {
                        // Botón "¿Solucionada?" que abre el modal
                        echo '<button onclick="abrirModal(\'' . htmlspecialchars($row["codigo"]) . '\')" class="button-solucionada">¿Solucionada?</button>';
                    } else if ($row["estado"] == 1) {
                        // Botón "Solucionada"
                        echo '<button class="button-solucion">Solucionada</button>';
                    } else {
                        echo htmlspecialchars($row["estado"]);
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron registros</td></tr>";
            }

            // Cerrar conexión
            $con->close();
            ?>
        </tbody>
    </table>

    <!-- Modal para ingresar el token -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Confirmar acción</h2>
            <p>Ingrese el token de seguridad para marcar la incidencia como solucionada:</p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" id="modalCodigo" name="codigo" value="">
                <input type="text" id="tokenInput" name="token" required>
                <button type="submit">Confirmar</button>
            </form>
        </div>
    </div>

    <script>
        // Función para abrir el modal y establecer el código de incidencia
        function abrirModal(codigo) {
            document.getElementById("modalCodigo").value = codigo;
            document.getElementById("myModal").style.display = "block";
        }

        // Función para cerrar el modal
        function cerrarModal() {
            document.getElementById("myModal").style.display = "none";
            document.getElementById("tokenInput").value = "";
        }

        // Cerrar modal haciendo clic fuera de él
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                cerrarModal();
            }
        }
    </script>
</body>
</html>
