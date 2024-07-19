<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_diario'])) {

    // receiving the post params
   
  
    $fecha_diario = $_POST['fecha_diario'];
    $responsable = $_POST['responsable'];
    $descripcion = $_POST['descripcion'];
    $codigo = $_POST['codigo'];
   
 


   
    $suceso = $db->storeDiario(
    
        $fecha_diario,
        $responsable,
  
        $descripcion,
        $codigo
    );

    if ($suceso != false) {
       
        $response["diario"]["id"] = $suceso["id"];
        $response["diario"]["fecha_diario"] = $suceso["fecha_diario"];
        $response["diario"]["responsable"] = $suceso["responsable"];
        $response["diario"]["descripcion"] = $suceso["descripcion"];
    
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
