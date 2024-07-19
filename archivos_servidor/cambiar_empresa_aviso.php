<?php
   header("Access-Control-Allow-Origin: *");
   require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $empresa = $_POST['empresa'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_avisos SET restringido_a = '".$empresa."' WHERE id= '".$id."'"); 
 
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