<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $foto = $_POST['foto'];
        $codigo = $_POST['codigo'];   
        
        $get_result = $con->query("INSERT INTO tb_fotos_partes_accidentes (codigo, archivo) VALUES ('".$codigo."', '".$foto."') "); 
 
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