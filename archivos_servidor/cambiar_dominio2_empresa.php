<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_empresas SET dominio2 ='".$nombre."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Dominio de empresa actualizada";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>