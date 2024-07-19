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
    $user = $db->getUserByEmailStateInterno($email);

    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
       $response["user"]["id"] = $user["id"];
       $response["user"]["tipo"] = $user["tipo"];
       $response["user"]["grupo"] = $user["grupo"];
      
    
         





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
