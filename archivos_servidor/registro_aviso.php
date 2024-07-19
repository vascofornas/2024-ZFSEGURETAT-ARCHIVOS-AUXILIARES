<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_inicio'])) {

    // receiving the post params
   
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $calle = $_POST['calle'];
    $descripcion = $_POST['descripcion'];
    $tipo_aviso = $_POST['tipo_aviso'];
    $activar_x_antes = $_POST['activar_x_antes'];
    $restringido_a = $_POST['restringido_a'];
    $diametro = $_POST['diametro'];
    $creado_por = $_POST['creado_por'];
    $titulo = $_POST['titulo'];
    $visibilidad = $_POST['visibilidad'];
 


   
    $aviso = $db->storeAviso(
        $fecha_inicio,
        $fecha_fin,
        $latitud,
        $longitud,
        $calle,
        $descripcion,
        $tipo_aviso,
        $activar_x_antes,
        $restringido_a,
        $diametro,
        $creado_por,
        $titulo,
        $visibilidad  
    );

    if ($aviso != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["aviso"]["id"] = $aviso["id"];
        $response["aviso"]["fecha_inicio"] = $aviso["fecha_inicio"];
        $response["aviso"]["fecha_fin"] = $aviso["fecha_fin"];
        $response["aviso"]["latitud"] = $aviso["latitud"];
        $response["aviso"]["longitud"] = $aviso["longitud"];
        $response["aviso"]["calle"] = $aviso["calle"];
        $response["aviso"]["descripcion"] = $aviso["descripcion"];
        $response["aviso"]["tipo_aviso"] = $aviso["tipo_aviso"];
        $response["aviso"]["activar_x_antes"] = $aviso["activar_x_antes"];
        $response["aviso"]["restringido_a"] = $aviso["restringido_a"];
        $response["aviso"]["diametro"] = $aviso["diametro"];
        $response["aviso"]["creado_por"] = $aviso["creado_por"];
        $response["aviso"]["titulo"] = $aviso["titulo"];
        $response["aviso"]["visibilidad"] = $aviso["visibilidad"];
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
