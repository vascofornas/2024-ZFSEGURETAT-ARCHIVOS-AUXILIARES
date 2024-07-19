<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';
//include_once("funciones.php");
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($email, $password);

    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
       $response["user"]["id"] = $user["id"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["imagen"] = $user["imagen"];
        $response["user"]["nombre"] = $user["nombre"];
        $response["user"]["apellidos"] = $user["apellidos"];
        $response["user"]["verificada"] = $user["verificada"];
        $response["user"]["activo"] = $user["activo"];
        $response["user"]["token_firebase"] = $user["token_firebase"];
        $response["user"]["tipo_usuario"] = $user["tipo_usuario"];
        $response["user"]["tipo_externo"] = $user["tipo_externo"];
         





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
