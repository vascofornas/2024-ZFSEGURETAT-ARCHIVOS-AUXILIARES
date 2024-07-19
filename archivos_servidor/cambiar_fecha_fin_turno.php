<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $codigo = $_POST['codigo'];
        $fecha = $_POST['fecha'];   
        
        $get_result = $con->query("UPDATE tb_turnos SET final='".$fecha."' WHERE codigo= '".$codigo."'"); 
 
        if($get_result === true){
        echo "Apellidos del usuario actualizados";
        $detalle = "User changes profile last name";
        
        }else{
        echo $username." Error actualizando apellidos del usuario";
        }
    }else{
        echo 'error';
    }
?>