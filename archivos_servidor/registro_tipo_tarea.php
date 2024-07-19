<?php
  header("Access-Control-Allow-Origin: *");
  require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $tipo = $_POST['tipo'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("INSERT INTO tb_tipos_tareas  (tipo) VALUES ('".$tipo."')"); 
 
        if($get_result === true){
        echo "OK";
        
        
        }else{
        
        }
    }else{
        echo 'error';
    }
?>