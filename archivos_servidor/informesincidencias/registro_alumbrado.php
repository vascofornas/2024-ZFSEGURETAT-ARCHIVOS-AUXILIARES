<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_alumbrado'])) {

    // receiving the post params
   
  
    $fecha_alumbrado = $_POST['fecha_alumbrado'];
    $responsable = $_POST['responsable'];
    $observaciones = $_POST['observaciones'];
    $turno = $_POST['turno'];
   
 


   
    $suceso = $db->storeAlumbrado(
    
        $fecha_alumbrado,
        $responsable,
        $observaciones,
        $turno
    );

    if ($suceso != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["alumbrado"]["id"] = $suceso["id"];
       
    
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
