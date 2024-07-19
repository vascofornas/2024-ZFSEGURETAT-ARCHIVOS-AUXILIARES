<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Archivos PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            margin-bottom: 20px;
        }
        header img {
            max-height: 80px;
            margin-right: 20px;
        }
        .filters {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        .filter-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .filter-form label,
        .filter-form select,
        .filter-form button,
        .filter-form input {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        th {
            background-color: #f4f4f4;
        }
        .button-descargar, .button-email {
            background-color: dodgerblue;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            border-radius: 4px;
        }
        #emailDialog {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        #emailDialog table {
            width: 100%;
        }
        #emailDialog th, #emailDialog td {
            padding: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <img src="zf.png" alt="Logotipo de ZF">
        <h1>Listado de Archivos PDF</h1>
    </header>
    <div class="filters">
        <div class="filter-form">
            <form method="get">
                <label for="date_filter">Mostrar archivos de los últimos:</label>
                <select name="date_filter" id="date_filter">
                    <option value="7" <?php if(isset($_GET['date_filter']) && $_GET['date_filter'] == '7') echo 'selected'; ?>>7 días</option>
                    <option value="15" <?php if(isset($_GET['date_filter']) && $_GET['date_filter'] == '15') echo 'selected'; ?>>15 días</option>
                    <option value="30" <?php if(isset($_GET['date_filter']) && $_GET['date_filter'] == '30') echo 'selected'; ?>>30 días</option>
                    <option value="all" <?php if(!isset($_GET['date_filter']) || $_GET['date_filter'] == 'all') echo 'selected'; ?>>Todos</option>
                </select>
                
                <label for="sort_order">Ordenar por fecha:</label>
                <select name="sort_order" id="sort_order">
                    <option value="desc" <?php if(isset($_GET['sort_order']) && $_GET['sort_order'] == 'desc') echo 'selected'; ?>>Más nuevo primero</option>
                    <option value="asc" <?php if(isset($_GET['sort_order']) && $_GET['sort_order'] == 'asc') echo 'selected'; ?>>Más antiguo primero</option>
                </select>
                
                <button type="submit">Filtrar</button>
            </form>
        </div>
        
        <div class="filter-form">
            <form method="get">
                <label for="search_file">Buscar por nombre de archivo:</label>
                <input type="text" id="search_file" name="search_file" value="<?php echo isset($_GET['search_file']) ? htmlspecialchars($_GET['search_file']) : ''; ?>">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
    
    <?php
    $directory = 'appseguridad/flutter_api/pdf/pdf';
    $dateFilter = isset($_GET['date_filter']) ? $_GET['date_filter'] : 'all';
    $sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'desc';
    $searchFile = isset($_GET['search_file']) ? $_GET['search_file'] : '';

    $files = array_diff(scandir($directory), array('.', '..'));
    $filteredFiles = [];

    $currentTime = time();

    foreach ($files as $file) {
        if (is_file($directory . '/' . $file)) {
            $filePath = $directory . '/' . $file;
            $fileCreationTime = filemtime($filePath);

            // Filtrar por fecha
            $includeFile = true;
            if ($dateFilter !== 'all') {
                $daysAgo = (int) $dateFilter;
                $thresholdTime = strtotime("-$daysAgo days", $currentTime);
                if ($fileCreationTime < $thresholdTime) {
                    $includeFile = false;
                }
            }

            // Filtrar por nombre de archivo
            if (!empty($searchFile)) {
                if (stripos($file, $searchFile) === false) {
                    $includeFile = false;
                }
            }

            if ($includeFile) {
                $filteredFiles[] = ['name' => $file, 'time' => $fileCreationTime];
            }
        }
    }

    // Mostrar el número de partes PDF listadas
    $numParts = count($filteredFiles);
    echo "<p>Número de partes PDF encontrados: $numParts partes</p>";
    ?>

    <table>
        <thead>
            <tr>
                <th>Archivo</th>
                <th>Fecha creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ordenar archivos por fecha
            if ($sortOrder === 'desc') {
                usort($filteredFiles, function($a, $b) {
                    return $b['time'] - $a['time'];
                });
            } else {
                usort($filteredFiles, function($a, $b) {
                    return $a['time'] - $b['time'];
                });
            }

            foreach ($filteredFiles as $file) {
                $filePath = $directory . '/' . $file['name'];
                $fileCreationTime = date('d-m-Y H:i:s', $file['time']);

                echo "<tr>";
                echo "<td>" . htmlspecialchars($file['name']) . "</td>";
                echo "<td>" . htmlspecialchars($fileCreationTime) . "</td>";
                echo "<td>
                        <a href='$filePath' class='button-descargar' download>Descargar</a>
                        <button class='button-email' data-file='$filePath'>Enviar email con el parte(PDF)</button>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <div id="emailDialog">
        <h3>Seleccionar receptores para enviar el PDF</h3>
        <form id="emailForm" method="post">
            <input type="hidden" name="filePath" id="filePath">
            <table>
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Departamento</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conexión a la base de datos y obtención de los registros
                    $conn = new mysqli('localhost', 'zfseguretat', 'g9hr#+-_awnoA', 'zfbarcelona_zfseguretat');
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }
                    $sql = "SELECT departamento, email FROM tb_receptores_pdf";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' name='emails[]' value='" . htmlspecialchars($row['email']) . "'></td>";
                            echo "<td>" . htmlspecialchars($row['departamento']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No se encontraron registros</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <button type="button" id="sendEmailButton">Enviar email a los seleccionados</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.button-email').on('click', function() {
                var filePath = $(this).data('file');
                $('#filePath').val(filePath);
                $('#emailDialog').show();
            });

            $('#sendEmailButton').on('click', function() {
                $('#emailForm').submit();
            });

            // Formulario de envío
            $('#emailForm').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'send_email.php',
                    data: formData,
                    success: function(response) {
                        alert(response);
                        $('#emailDialog').hide();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + error);
                        console.error('Status: ' + status);
                        console.dir(xhr);
                        alert('Error al enviar los emails.');
                    }
                });
            });
        });
    </script>
</body>
</html>
