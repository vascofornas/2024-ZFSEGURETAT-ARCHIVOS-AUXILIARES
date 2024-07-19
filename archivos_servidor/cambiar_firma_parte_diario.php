<?php
   header("Access-Control-Allow-Origin: *");
   require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $firma = $_POST['firma'];
        $turno = $_POST['turno'];   
        
        $get_result = $con->query("UPDATE tb_diario SET firma_resp = '".$firma."' WHERE turno= '".$turno."'"); 
 
        if($get_result === true){
        echo "Diameto aviso actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>