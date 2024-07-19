<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_alumbrado= $_POST['id'];
       
        
        $get_result = $con->query("DELETE FROM  tb_farolas  WHERE id = '".$id_alumbrado."'"); 
 
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