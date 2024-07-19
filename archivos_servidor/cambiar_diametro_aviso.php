<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $metros = $_POST['metros'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_avisos SET diametro = '".$metros."' WHERE id= '".$id."'"); 
 
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