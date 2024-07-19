<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $inicio = $_POST['inicio'];
        $responsable = $_POST['responsable']; 
        $patrulla = $_POST['patrulla'];   
        $vigilante1 = $_POST['vigilante1']; 
        $vigilante2 = $_POST['vigilante2'];  
        $turno = $_POST['turno']; 
        $estado = $_POST['estado'];   
        $codigo = $_POST['codigo'];   
        $firmaV1 = $_POST['firmaV1']; 
        $firmaV2 = $_POST['firmaV2'];   
        $responsableservicio = $_POST['responsableservicio'];  
        
        $get_result = $con->query("INSERT INTO tb_turnos  (
            inicio,responsable, patrulla, vigilante1,vigilante2,turno,estado,codigo,responsableservicio, firmaV1, firmaV2) 
            VALUES ('".$inicio."', '".$responsable."', '".$patrulla."' , '".$vigilante1."' , '".$vigilante2."' , 
            '".$turno."' , '".$estado."' , '".$codigo."', '".$responsableservicio."', '".$firmaV1."', '".$firmaV2."')"); 
 
        if($get_result === true){
        echo "OK";
        
        
        }else{
        
        }
    }else{
        echo 'error';
    }
?>