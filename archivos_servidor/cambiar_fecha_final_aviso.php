<?php
   header("Access-Control-Allow-Origin: *");
   require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $fecha_final = $_POST['fecha_final'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_avisos SET fecha_fin = '".$fecha_final."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "fecha final del aviso actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>