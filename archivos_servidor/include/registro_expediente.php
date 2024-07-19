<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['titulo'])) {

    // receiving the post params
   
    $titulo = $_POST['titulo'];
    $estado = $_POST['estado'];
    $fecha_apertura = $_POST['fecha_apertura'];
    $fecha_cierre = $_POST['fecha_cierre'];
    $responsable = $_POST['responsable'];
    $tipo = $_POST['tipo'];
   
  
 


   
    $expediente = $db->storeExpediente(
        $titulo,
        $estado,
        $fecha_apertura,
        $fecha_cierre,
        $responsable,
        $tipo

    );

    if ($expediente != false) {
        // expediente is created
       $response["error"] = FALSE;
        $response["expediente"]["id"] = $expediente["id"];
        $response["expediente"]["titulo"] = $expediente["titulo"];
        $response["expediente"]["estado"] = $expediente["estado"];
        $response["expediente"]["fecha_apertura"] = $expediente["fecha_apertura"];
        $response["expediente"]["fecha_cierre"] = $expediente["fecha_cierre"];
        $response["expediente"]["responsable"] = $expediente["responsable"];
        $response["expediente"]["tipo"] = $expediente["tipo"];
       
       
        
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
