<?php
header("Access-Control-Allow-Origin: *");
require_once('connect.php');

// json response array
$response = array("error" => FALSE);

if($_SERVER['REQUEST_METHOD']=='POST') {

    // receiving the post params

    $id = $_POST['id'];
   
    $titulo = $_POST['titulo'];
    $fecha_suceso = $_POST['fecha_suceso'];
    $responsable = $_POST['responsable'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $calle = $_POST['calle'];
    $descripcion = $_POST['descripcion'];
   
 
    $get_result = $con->query("UPDATE tb_sucesos SET 
    titulo='".$titulo."',
    descripcion = '".$descripcion."',
    responsable = '".$responsable."',
    latitud = '".$latitud."',
    longitud = '".$longitud."',
    calle = '".$calle."'
    
    
    WHERE id= '".$id."'"); 

    if($get_result === true){
        echo "Suceso actualizado";
        $detalle = "User changes profile picture";
        
        }else{
        echo $username." Error actualizando foto de usuario";
        }

    }
?>
