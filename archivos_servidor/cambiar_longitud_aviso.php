<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $longitud = $_POST['longitud'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_avisos SET longitud='".$longitud."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "latitud de aviso actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>