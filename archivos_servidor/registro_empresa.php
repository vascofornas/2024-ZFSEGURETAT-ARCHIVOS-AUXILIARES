<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';
//include_once("funciones.php");
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['nombre']) && isset($_POST['logo'])) {

    // receiving the post params
    $nombre = $_POST['nombre'];
    $logo = $_POST['logo'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $dominio = $_POST['dominio'];
    $dominio2 = $_POST['dominio2'];
    $dominio3 = $_POST['dominio3'];
    $dominio4 = $_POST['dominio4'];
    $direccion = $_POST['direccion'];
    

    // get the user by email and password
    $empresa = $db->storeEmpresa($nombre, $latitud, $longitud, $dominio, $dominio2, $dominio3,$dominio4, $logo, $direccion);

    if ($empresa != false) {
        // use is found
        $response["error"] = FALSE;
       
        $response["empresa"]["nombre"] = $empresa["nombre"];
    
        $response["empresa"]["logo"] = $empresa["logo"];
  

        //echo json_encode($response);
       echo json_encode( $response, JSON_UNESCAPED_UNICODE );

    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Datos incorrectos";
        echo json_encode( $response, JSON_UNESCAPED_UNICODE );
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Faltan email o contraseña";
    echo json_encode( $response, JSON_UNESCAPED_UNICODE );
}
?>
