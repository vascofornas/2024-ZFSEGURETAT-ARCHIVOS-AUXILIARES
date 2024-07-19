<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_abandonado= $_POST['id'];
       
        
        $get_result = $con->query("DELETE FROM  tb_vehiculos_abandonados  WHERE id = '".$id_abandonado."'"); 
 
        if($get_result === true){
        echo "vehiculo borrado ";
        echo $id_abandonado;
        $detalle = "User changes profile picture";
        
        }else{
        echo $username." Error actualizando foto de usuario";
        }
    }else{
        echo 'error';
    }
?>