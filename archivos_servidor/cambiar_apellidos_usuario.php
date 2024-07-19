<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $apellidos = $_POST['apellidos'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_usuarios SET apellidos='".$apellidos."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Apellidos del usuario actualizados";
        $detalle = "User changes profile last name";
        
        }else{
        echo $username." Error actualizando apellidos del usuario";
        }
    }else{
        echo 'error';
    }
?>