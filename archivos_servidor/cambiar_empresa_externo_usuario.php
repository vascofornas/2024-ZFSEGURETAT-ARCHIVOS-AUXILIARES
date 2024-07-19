<?php
   header("Access-Control-Allow-Origin: *");
   require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $empresa = $_POST['empresa'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_usuarios_externos SET empresa = '".$empresa."', id_tipo_ext = 2  WHERE id_usuario= '".$id."'"); 
 
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