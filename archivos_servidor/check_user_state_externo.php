<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';
//include_once("funciones.php");
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email'])) {

    // receiving the post params
    $email = $_POST['email'];
    
    

    // get the user by email and password
    $user = $db->getUserByEmailStateExterno($email);

    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
       $response["user"]["id"] = $user["id"];
       $response["user"]["tipo"] = $user["tipo"];
       $response["user"]["empresa_nombre"] = $user["empresa_nombre"];
       $response["user"]["empresa_dominio"] = $user["empresa_dominio"];
       $response["user"]["empresa_dominio2"] = $user["empresa_dominio2"];
       $response["user"]["empresa_dominio3"] = $user["empresa_dominio3"];
       $response["user"]["empresa_dominio4"] = $user["empresa_dominio4"];
       $response["user"]["empresa_id"] = $user["empresa_id"];
       $response["user"]["empresa_logo"] = $user["empresa_logo"];
       $response["user"]["empresa_latitud"] = $user["empresa_latitud"];
       $response["user"]["empresa_longitud"] = $user["empresa_longitud"];
       $response["user"]["empresa_direccion"] = $user["empresa_direccion"];
       
      
    
         





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
