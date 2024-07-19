<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
      
       
        $id = $_POST['id'];
        $fecha_abandonados = $_POST['fecha_abandonados'];
        $tipo = $_POST['tipo'];
        $matricula = $_POST['matricula'];
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $direccion = $_POST['direccion'];
        $enganx_groga = $_POST['enganx_groga'];
        $enganx_verda = $_POST['enganx_verda'];
        $denuncia = $_POST['denuncia'];
        $observaciones = $_POST['observaciones'];
      
  

        $get_result = $con->query("UPDATE 
        tb_vehiculos_abandonados 
        SET 
        fecha_abandonados ='".$fecha_abandonados."',
        tipo ='".$tipo."',
        modelo ='".$modelo."',
        matricula ='".$matricula."',
        color ='".$color."',
        direccion ='".$direccion."',
        enganx_groga ='".$enganx_groga."',
        enganx_verda ='".$enganx_verda."',
        denuncia ='".$denuncia."',
        observaciones ='".$observaciones."'
     
        
        
        WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Vehículo actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>