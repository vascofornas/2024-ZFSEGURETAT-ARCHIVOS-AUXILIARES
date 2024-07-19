<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $fecha_inicio = $_POST['fecha_inicio'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_avisos SET fecha_inicio = '".$fecha_inicio."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "fecha de inicio del aviso actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>