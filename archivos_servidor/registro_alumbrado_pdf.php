<?php
header("Access-Control-Allow-Origin: *");


require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['turno'])) {

    // receiving the post params
   
  
    $turno = $_POST['turno'];
    $firma1 = $_POST['firma1'];
    $firma2 = $_POST['firma2'];
    $observaciones = $_POST['observaciones'];
    $responsable = $_POST['responsable'];
    

 


   
    $suceso = $db->storeAlumbradopdfPrevia(
    
        $turno,
        $firma1,
        $firma2,
        $observaciones,
        $responsable
    );

    if ($suceso != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["farola"]["id"] = $suceso["id"];
        $response["farola"]["turno"] = $suceso["turno"];
        $response["farola"]["firma1"] = $suceso["firma1"];
        $response["farola"]["firma2"] = $suceso["firma2"];
        $response["farola"]["observaciones"] = $suceso["observaciones"];
        $response["farola"]["responsable"] = $suceso["responsable"];
        $response["farola"]["descripcion"] = $aviso["descripcion"];
       
    
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
