<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_control_incidencias'])) {

    // receiving the post params
   
    $fecha_control_incidencias = $_POST['fecha_control_incidencias'];
    $responsable = $_POST['responsable'];
    $turno = $_POST['turno'];
    $codigo_turno = $_POST['codigo_turno'];
    $aviso_mantenimiento = $_POST['aviso_mantenimiento'];
    $aviso_policia = $_POST['aviso_policia'];
    $km_inicio = $_POST['km_inicio'];
    $km_final = $_POST['km_final'];
    $km_totales = $_POST['km_totales'];
    $robos = $_POST['robos'];
    $rondas = $_POST['rondas'];
    $alarmas = $_POST['alarmas'];
    $accidentes = $_POST['accidentes'];
  
 


   
    $incidencia = $db->storeControlIncidencias(
        $fecha_control_incidencias,
        $responsable,
        $turno,
        $codigo_turno,
        $aviso_mantenimiento,
        $aviso_policia,
        $km_inicio,
        $km_final,
        $km_totales,
        $robos,
        $rondas,
        $alarmas,
        $accidentes
    );

    if ($incidencia != false) {
        // incidencia is created
       $response["error"] = FALSE;
        $response["incidencia"]["id"] = $incidencia["id"];
        $response["incidencia"]["fecha_control_incidencias"] = $incidencia["fecha_control_incidencias"];
       
        
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
