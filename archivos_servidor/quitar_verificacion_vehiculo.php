<?php
    header("Access-Control-Allow-Origin: *");

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_informe = $_POST['id'];
       
        
        $get_result = $con->query("DELETE FROM  tb_verificacion_vehiculos  WHERE id = '".$id_informe."'"); 
 
        if($get_result === true){
        echo "Foto de usuario actualizada";
        $detalle = "User changes profile picture";
        
        }else{
        echo $username." Error actualizando foto de usuario";
        }
    }else{
        echo 'error';
    }
?>