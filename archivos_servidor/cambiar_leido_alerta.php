<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
       
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_alertas SET leida = 1 WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Leido alerta actualizados";
        $detalle = "User changes leido alerta";
        
        }else{
        echo $username." Error actualizando leido alerta";
        }
    }else{
        echo 'error';
    }
?>