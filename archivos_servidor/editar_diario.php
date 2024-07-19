<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_diario = $_POST['id_diario'];
        $desc_diario = $_POST['desc_diario']; 
        $fecha_diario = $_POST['fecha_diario'];   
        
        $get_result = $con->query("UPDATE tb_diario SET descripcion='".$desc_diario."', fecha_diario='".$fecha_diario."' WHERE id= '".$id_diario."'"); 
 
        if($get_result === true){
        echo "DiarIo actualizados";
        $detalle = "User changes profile last name";
        
        }else{
        echo $username." Error actualizando apellidos del usuario";
        }
    }else{
        echo 'error';
    }
?>