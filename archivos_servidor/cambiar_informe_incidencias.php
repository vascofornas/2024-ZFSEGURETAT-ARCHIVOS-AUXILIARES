<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $titulo = $_POST['titulo'];
        $id = $_POST['id'];
        $descripcion = $_POST['descripcion'];
        $descripcion2 = $_POST['descripcion2'];
        $descripcion3 = $_POST['descripcion3'];
        $descripcion4 = $_POST['descripcion4'];
        $descripcion5 = $_POST['descripcion5'];
        $descripcion6 = $_POST['descripcion6'];
        $descripcion7 = $_POST['descripcion7'];
        $descripcion8 = $_POST['descripcion8'];
        $descripcion9 = $_POST['descripcion9'];
        $descripcion10 = $_POST['descripcion10'];
        $descripcion11 = $_POST['descripcion11'];
        $descripcion12 = $_POST['descripcion12'];
        $descripcion13 = $_POST['descripcion13'];
        $descripcion14 = $_POST['descripcion14'];
        $descripcion15 = $_POST['descripcion15'];
        $descripcion16 = $_POST['descripcion16'];
        $descripcion17 = $_POST['descripcion17'];  
        $descripcion18 = $_POST['descripcion18'];
        $descripcion19 = $_POST['descripcion19'];
        $descripcion20 = $_POST['descripcion20'];
        $descripcion21 = $_POST['descripcion21'];
        $descripcion22 = $_POST['descripcion22'];
        $firmaResponsable = $_POST['firmaResponsable'];
        $firmaResponsable2 = $_POST['firmaResponsable2'];

        $turnoservicio= $_POST['turnoservicio'];  
        $vigilanteservicio= $_POST['vigilanteservicio'];  
        $responsableservicio= $_POST['responsableservicio']; 
        $numerofotos= $_POST['numerofotos'];  

        $get_result = $con->query("UPDATE 
        tb_informe_incidencias 
        SET 
        descripcion ='".$descripcion."',
        descripcion2 ='".$descripcion2."',
        descripcion3 ='".$descripcion3."',
        descripcion4 ='".$descripcion4."',
        descripcion5 ='".$descripcion5."',
        descripcion6 ='".$descripcion6."',
        descripcion7 ='".$descripcion7."',
        descripcion8 ='".$descripcion8."',
        descripcion9 ='".$descripcion9."',
        descripcion10 ='".$descripcion10."',
        descripcion11 ='".$descripcion11."',
        descripcion12 ='".$descripcion12."',
        descripcion13 ='".$descripcion13."',
        descripcion14 ='".$descripcion14."',
        descripcion15 ='".$descripcion15."',
        descripcion16 ='".$descripcion16."',
        descripcion17 ='".$descripcion17."',
        descripcion18 ='".$descripcion18."',
        descripcion19 ='".$descripcion19."',
        descripcion20 ='".$descripcion20."',
        descripcion21 ='".$descripcion21."',
        descripcion22 ='".$descripcion22."',
        firma_resp ='".$firmaResponsable."',
        firma_resp2 ='".$firmaResponsable2."',

        titulo ='".$titulo."',
        turnoservicio ='".$turnoservicio."',
        vigilanteservicio ='".$vigilanteservicio."',
        responsableservicio ='".$responsableservicio."',
        numerofotos ='".$numerofotos."'
        
        
        WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Titulo de aviso actualizado";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>