<?php
   header("Access-Control-Allow-Origin: *");
   require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $horas = $_POST['horas'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_avisos SET activar_x_antes = '".$horas."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Activar x horas antes aviso actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>