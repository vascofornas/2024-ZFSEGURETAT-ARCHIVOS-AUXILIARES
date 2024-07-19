<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $grupo = $_POST['grupo'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_usuarios_internos SET id_grupo_interno = '".$grupo."' WHERE id_usuario= '".$id."'"); 
 
        if($get_result === true){
        echo "Nombre de usuario actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>