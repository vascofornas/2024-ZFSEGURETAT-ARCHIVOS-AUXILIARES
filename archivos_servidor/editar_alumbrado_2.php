<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = $_POST['id'];
        $descripcion = $_POST['descripcion']; 
        $fecha_farola = $_POST['fecha_farola'];  
        $calle = $_POST['calle'];
        $farola = $_POST['farola'];
        $estado = $_POST['estado']; 
        
        $get_result = $con->query("UPDATE tb_farolas SET 
        descripcion='".$descripcion."', 
        fecha_farola='".$fecha_farola."' ,
        calle='".$calle."', 
        farola='".$farola."',
        estado='".$estado."' 
        
        
        
        WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Alumbrado 2 actualizado";
        $detalle = "User changes profile last name";
        
        }else{
        echo $username." Error actualizando apellidos del usuario";
        }
    }else{
        echo 'error';
    }
?>