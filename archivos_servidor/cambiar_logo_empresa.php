<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $foto = $_POST['foto'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_empresas SET logo='".$foto."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Logo de empresa actualizado";
        $detalle = "User changes profile picture";
        
        }else{
        echo $username." Error actualizando logo de empresa";
        }
    }else{
        echo 'error';
    }
?>