<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_incidencia'])) {

    // receiving the post params
   
    $fecha_incidencia = $_POST['fecha_incidencia'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $calle = $_POST['calle'];
    $descripcion = $_POST['descripcion'];
    $motivo = $_POST['motivo'];
    $creado_por = $_POST['creado_por'];
    $estado = $_POST['estado'];
  
 


   
    $incidencia = $db->storeIncidencia(
        $fecha_incidencia,
        $latitud,
        $longitud,
        $calle,
        $descripcion,
        $motivo,
        $creado_por,
        $estado
    );

    if ($incidencia != false) {
        // incidencia is created
       $response["error"] = FALSE;
        $response["incidencia"]["id"] = $incidencia["id"];
        $response["incidencia"]["fecha_incidencia"] = $incidencia["fecha_incidencia"];
        $response["incidencia"]["latitud"] = $incidencia["latitud"];
        $response["incidencia"]["longitud"] = $incidencia["longitud"];
        $response["incidencia"]["calle"] = $incidencia["calle"];
        $response["incidencia"]["descripcion"] = $incidencia["descripcion"];
        $response["incidencia"]["motivo"] = $incidencia["motivo"];
        $response["incidencia"]["creado_por"] = $incidencia["creado_por"];
        $response["incidencia"]["estado"] = $aviso["estado"];
        
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
