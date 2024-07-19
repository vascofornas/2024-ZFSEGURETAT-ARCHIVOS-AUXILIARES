<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_farola'])) {

    // receiving the post params
   
  
    $fecha_farola = $_POST['fecha_farola'];
    $responsable = $_POST['responsable'];
    $descripcion = $_POST['descripcion'];
    $codigo = $_POST['codigo'];
    $calle = $_POST['calle'];
    $farola = $_POST['farola'];
    $estado = $_POST['estado'];
   

 


   
    $suceso = $db->storeAlumbrado2(
    
        $fecha_farola,
        $responsable,
        $descripcion,
        $codigo,
        $calle,
        $farola,
        $estado
    );

    if ($suceso != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["farola"]["id"] = $suceso["id"];
        $response["farola"]["fecha_farola"] = $suceso["fecha_farola"];
        $response["farola"]["responsable"] = $suceso["responsable"];
        $response["farola"]["descripcion"] = $aviso["descripcion"];
        $response["farola"]["turno"] = $aviso["turno"];
    
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
