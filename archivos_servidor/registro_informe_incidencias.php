<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_incidencia'])) {

    // receiving the post params
   
  
    $fecha_incidencia = $_POST['fecha_incidencia'];
    $responsable = $_POST['responsable'];
    $descripcion = $_POST['descripcion'];
       $descripcion2 = $_POST['descripcion2'];
    $titulo = $_POST['titulo'];
    $codigo = $_POST['codigo'];
    $turno_servicio = $_POST['turno_servicio'];
    $vigilante_servicio = $_POST['vigilante_servicio'];
    $responsable_servicio = $_POST['responsable_servicio'];
    $codigoturno = $_POST['codigoturno'];
    $patrulla = $_POST['patrulla'];
    $numerofotos = $_POST['numerofotos'];
    $firma_resp = $_POST['firma_resp'];
    $firma_resp2 = $_POST['firma_resp2'];

    $descripcion3 = $_POST['descripcion3'];
    $descripcion4 = $_POST['descripcion4'];
    $descripcion5 = $_POST['descripcion5'];
    $descripcion6 = $_POST['descripcion6'];
    $descripcion7 = $_POST['descripcion7'];
    $descripcion8 = $_POST['descripcion8'];
    $descripcion9 = $_POST['descripcion9'];
    $descripcion10 = $_POST['descripcion10'];
    $descripcion11 = $_POST['descripcion11'];
    $descripcion12 = $_POST['descripcion12'];
    $descripcion13 = $_POST['descripcion13'];
    $descripcion14 = $_POST['descripcion14'];
    $descripcion15 = $_POST['descripcion15'];
    $descripcion16 = $_POST['descripcion16'];
    $descripcion17 = $_POST['descripcion17'];
    $descripcion18 = $_POST['descripcion18'];
    $descripcion19 = $_POST['descripcion19'];
    $descripcion20 = $_POST['descripcion20'];
    $descripcion21 = $_POST['descripcion21'];
    $descripcion22 = $_POST['descripcion22'];
    

 


   
    $suceso = $db->storeInformeIncidencias(
    
        $fecha_incidencia,
        $responsable,
        $descripcion,
        $descripcion2,
        $codigo,
        $turno_servicio,
        $vigilante_servicio,
        $responsable_servicio,
        $titulo,
        $codigoturno,
        $patrulla,
        $numerofotos,
        $firma_resp,
        $firma_resp2,
        $descripcion3,
        $descripcion4,
        $descripcion5,
        $descripcion6,
        $descripcion7,
        $descripcion8,
        $descripcion9,
        $descripcion10,
        $descripcion11,
        $descripcion12,
        $descripcion13,
        $descripcion14,
        $descripcion15,
        $descripcion16,
        $descripcion17,
        $descripcion18,
        $descripcion19,
        $descripcion20,
        $descripcion21,
        $descripcion22
    );

    if ($suceso != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["informe"]["id"] = $suceso["id"];
        $response["informe"]["fecha_incidencia"] = $suceso["fecha_incidencia"];
        $response["informe"]["responsable"] = $suceso["responsable"];
        $response["informe"]["descripcion"] = $suceso["descripcion"];
        $response["informe"]["codigo"] = $suceso["codigo"];
    
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
