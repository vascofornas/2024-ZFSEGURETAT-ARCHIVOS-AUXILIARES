<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $estado = $_POST['estado'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_incidencias SET estado = '".$estado."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Estado incidencia actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>