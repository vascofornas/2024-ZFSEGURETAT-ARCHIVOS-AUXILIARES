<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $foto = $_POST['foto'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_usuarios SET imagen='".$foto."' WHERE id= '".$id."'"); 
 
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