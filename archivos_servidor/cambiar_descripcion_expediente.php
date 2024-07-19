<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $desc = $_POST['desc'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_expedientes SET descripcion = '".$desc."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
      
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>