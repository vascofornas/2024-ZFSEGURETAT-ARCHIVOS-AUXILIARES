<?php
   header("Access-Control-Allow-Origin: *");
   require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $latitud = $_POST['latitud'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_avisos SET latitud='".$latitud."' WHERE id= '".$id."'"); 
 
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