<?php
  header("Access-Control-Allow-Origin: *");
  require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $d2 = $_POST['titulo'];
        $d3 = $_POST['tipo'];
        $d4 = $_POST['archivo'];
        $d5 = $_POST['expediente'];
        $d6 = $_POST['descripcion'];
    
         
        
        $get_result = $con->query("INSERT INTO tb_archivos_exp  
        (titulo,
        tipo,
        archivo,
        expediente,
        descripcion
        
        
        
        ) 
        VALUES (
            '".$d2."',
            '".$d3."',
            '".$d4."',
            '".$d5."',
            '".$d6."'
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