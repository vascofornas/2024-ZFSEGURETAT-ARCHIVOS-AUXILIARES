<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_hora_inicio_programada'])) {

    // receiving the post params
   
    $usuario_asignado = $_POST['usuario_asignado'];
    $descripcion = $_POST['descripcion'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $ubicacion = $_POST['ubicacion'];
    $titulo = $_POST['titulo'];
    $edificio = $_POST['edificio'];
    $planta = $_POST['planta'];
    $estancia = $_POST['estancia'];
  
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];
    $tipo = $_POST['tipo'];
    $fecha_hora_vencimiento = $_POST['fecha_hora_vencimiento'];
    $fecha_hora_inicio_programada = $_POST['fecha_hora_inicio_programada'];
    $fecha_hora_inicio_efectiva = $_POST['fecha_hora_inicio_efectiva'];
    $fecha_hora_fin = $_POST['fecha_hora_fin'];
    $estado = $_POST['estado'];
    $asignada_a_usuario = $_POST['asignada_a_usuario'];
    $asignada_a_grupo = $_POST['asignada_a_grupo'];
    $grupo = $_POST['grupo'];


  
    $tarea = $db->storeTarea(
        $usuario_asignado,
        $descripcion,
        $latitud,
        $longitud,
        $ubicacion,
        $titulo,
        $edificio,
        $planta,
        $estancia,
      
        $categoria,
        $subcategoria,
        $tipo,
        $fecha_hora_vencimiento,
        $fecha_hora_inicio_programada,
        $fecha_hora_inicio_efectiva,
        $fecha_hora_fin,
        $estado,
        $asignada_a_usuario,
        $asignada_a_grupo,
        $grupo  
    );

    if ($tarea != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["tarea"]["id"] = $tarea["id"];
        $response["tarea"]["usuario_asignado"] = $tarea["usuario_asignado"];
        $response["tarea"]["descripcion"] = $tarea["descripcion"];
        $response["tarea"]["latitud"] = $tarea["latitud"];
        $response["tarea"]["longitud"] = $tarea["longitud"];
        $response["tarea"]["ubicacion"] = $tarea["ubicacion"];
        $response["tarea"]["titulo"] = $tarea["titulo"];
        $response["tarea"]["edificio"] = $tarea["edificio"];
        $response["tarea"]["planta"] = $tarea["planta"];
        $response["tarea"]["estancia"] = $tarea["estancia"];
       
        $response["tarea"]["categoria"] = $tarea["categoria"];
        $response["tarea"]["subcategoria"] = $tarea["subcategoria"];
        $response["tarea"]["tipo"] = $tarea["tipo"];
        $response["tarea"]["fecha_hora_vencimiento"] = $tarea["fecha_hora_vencimiento"];
        $response["tarea"]["fecha_hora_inicio_programado"] = $tarea["fecha_hora_inicio_programado"];
        $response["tarea"]["fecha_hora_inicio_efectiva"] = $tarea["fecha_hora_inicio_efectiva"];
        $response["tarea"]["fecha_hora_inicio_fin"] = $tarea["fecha_hora_inicio_fin"];
        $response["tarea"]["expediente"] = $tarea["expediente"];
        $response["tarea"]["estado"] = $tarea["estado"];
        $response["tarea"]["asignada_a_usuario"] = $tarea["asignada_a_usuario"];
        $response["tarea"]["asignada_a_grupo"] = $tarea["asignada_a_grupo"];
        $response["tarea"]["grupo"] = $tarea["grupo"];
   
      
       $response["error"] = FALSE;
       echo json_encode( $response, JSON_UNESCAPED_UNICODE );

    } else {
        // aviso is not created
        $response["error"] = TRUE;
        $response["error_msg"] = "Datos incorrectos";
        echo json_encode( $response, JSON_UNESCAPED_UNICODE );
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Faltan datos";
    echo json_encode( $response, JSON_UNESCAPED_UNICODE );
}
?>
