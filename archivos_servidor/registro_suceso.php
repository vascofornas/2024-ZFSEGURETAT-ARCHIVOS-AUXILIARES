<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_suceso'])) {

    // receiving the post params
   
    $titulo = $_POST['titulo'];
    $fecha_suceso = $_POST['fecha_suceso'];
    $responable = $_POST['responsable'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $calle = $_POST['calle'];
    $descripcion = $_POST['descripcion'];
   
 


   
    $suceso = $db->storeSuceso(
        $titulo,
        $fecha_suceso,
        $responable,
        $latitud,
        $longitud,
        $calle,
        $descripcion
    );

    if ($suceso != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["suceso"]["id"] = $suceso["id"];
        $response["suceso"]["titulo"] = $suceso["titulo"];
        $response["suceso"]["fecha_suceso"] = $suceso["fecha_suceso"];
        $response["suceso"]["responsable"] = $suceso["responsable"];
        $response["suceso"]["latitud"] = $suceso["latitud"];
        $response["suceso"]["longitud"] = $aviso["longitud"];
        $response["suceso"]["calle"] = $aviso["calle"];
        $response["suceso"]["descripcion"] = $aviso["descripcion"];
    
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
