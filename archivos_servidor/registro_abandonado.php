<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_abandonados'])) {

    // receiving the post params
   
  
    $fecha_abandonados = $_POST['fecha_abandonados'];
    $responsable = $_POST['responsable'];
    $turno = $_POST['turno'];
    $tipo = $_POST['tipo'];
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $direccion = $_POST['direccion'];
    $enganx_groga = $_POST['enganx_groga'];
    $enganx_verda = $_POST['enganx_verda'];
    $denuncia = $_POST['denuncia'];
    $observaciones = $_POST['observaciones'];
    $patrulla = $_POST['patrulla'];
    $responsable_servicio = $_POST['responsable_servicio'];
    $vigilante_1 = $_POST['vigilante_1'];
    $vigilante_2 = $_POST['vigilante_2'];
   
 


   
    $suceso = $db->storeAbandonado(
    
        $fecha_abandonados,
        $responsable,
        $turno,
        $tipo,
        $matricula,
        $modelo,
        $color,
        $direccion,
        $enganx_groga,
        $enganx_verda,
        $denuncia,
        $observaciones,
        $patrulla,
        $responsable_servicio,
        $vigilante_1,
        $vigilante_2
    );

    if ($suceso != false) {
       
        $response["diario"]["id"] = $suceso["id"];
        $response["diario"]["fecha_abandonados"] = $suceso["fecha_abandonados"];
        $response["diario"]["responsable"] = $suceso["responsable"];
        $response["diario"]["turno"] = $suceso["turno"];
    
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
