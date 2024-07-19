<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_parte_canero'])) {

    // receiving the post params
   
    $fecha_parte_canero = $_POST['fecha_parte_canero'];
    $responsable = $_POST['responsable'];
    $turno = $_POST['turno'];
    $codigo_turno = $_POST['codigo_turno'];
    $canero = $_POST['canero'];
    $can = $_POST['can'];
    $perrera = $_POST['perrera'];
    $bebedero = $_POST['bebedero'];
    $correa = $_POST['correa'];
    $bozal = $_POST['bozal'];
    $arnes = $_POST['arnes'];
    $documentacion = $_POST['documentacion'];
    $pienso = $_POST['pienso'];
    $observaciones = $_POST['observaciones'];
    $firma = $_POST['firma'];
    $collar = $_POST['collar'];
  
 


   
    $incidencia = $db->storeParteCanero(
        $fecha_parte_canero,
        $responsable,
        $turno,
        $codigo_turno,
        $canero,
        $can,
        $perrera,
        $bebedero,
        $correa,
        $bozal,
        $arnes,
        $documentacion,
        $pienso,
        $observaciones,
        $firma,
        $collar
    );

    if ($incidencia != false) {
        // incidencia is created
       $response["error"] = FALSE;
        $response["incidencia"]["id"] = $incidencia["id"];
        $response["incidencia"]["fecha_parte_canero"] = $incidencia["fecha_parte_canero"];
       
        
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
