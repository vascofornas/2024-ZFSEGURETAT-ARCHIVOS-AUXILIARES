<?php

header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $token = $_POST['token'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_usuarios SET token_firebase='".$token."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Token FB del usuario actualizado";
        $detalle = "User changes profile last name";
        
        }else{
        echo $username." Error actualizando apellidos del usuario";
        }
    }else{
        echo 'error';
    }
?>