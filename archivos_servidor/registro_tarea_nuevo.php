<?php
  header("Access-Control-Allow-Origin: *");
  require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $d2 = $_POST['usuario_asignado'];
        $d3 = $_POST['descripcion'];
        $d4 = $_POST['latitud'];
        $d5 = $_POST['longitud'];
        $d6 = $_POST['ubicacion'];
        $d7 = $_POST['titulo'];
        $d8 = $_POST['edificio'];
        $d9 = $_POST['planta'];
        $d10 = $_POST['estancia'];
        $d11 = $_POST['categoria'];
        $d12 = $_POST['subcategoria'];
        $d13 = $_POST['tipo'];
        $d14 = $_POST['fecha_hora_vencimiento'];
        $d15 = $_POST['fecha_hora_inicio_programada'];
        $d16 = $_POST['fecha_hora_inicio_efectiva'];
        $d17 = $_POST['fecha_hora_fin'];
        $d20 = $_POST['asignada_a_usuario'];
        $d21 = $_POST['asignada_a_grupo'];
        $d22 = $_POST['grupo'];
        $d23 = $_POST['tiene_supervisor'];
        $d24 = $_POST['supervisor'];
        $d25 = $_POST['geolocalizada'];
         
        
        $get_result = $con->query("INSERT INTO tb_tareas  
        (usuario_asignado,
        descripcion,
        latitud,
        longitud,
        ubicacion,
        titulo,
        edificio,
        planta,
        estancia,
        categoria,
        subcategoria,
        tipo,
        fecha_hora_vencimiento,
        fecha_hora_inicio_programada,
        fecha_hora_inicio_efectiva,
        fecha_hora_fin,
        asignada_a_usuario,
        asignada_a_grupo,
        grupo,
        tiene_supervisor,
        supervisor,
        geolocalizada
        
        
        
        ) 
        VALUES (
            '".$d2."',
            '".$d3."',
            '".$d4."',
            '".$d5."',
            '".$d6."',
            '".$d7."',
            '".$d8."',
            '".$d9."',
            '".$d10."',
            '".$d11."',
            '".$d12."',
            '".$d13."',
            '".$d14."',
            '".$d15."',
            '".$d16."',
            '".$d17."',
            '".$d20."',
            '".$d21."',
            '".$d22."',
            '".$d23."',
            '".$d24."',
            '".$d25."'
            )"); 
 
        if($get_result === true){
        echo "OK";
        
        
        }else{
            echo "NO OK";
            echo $d2;
        
        }
    }else{
        echo 'error';
    }
?>