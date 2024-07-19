<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("INSERT INTO tb_categorias_tareas  (categoria) VALUES ('".$categoria."')"); 
 
        if($get_result === true){
        echo "OK";
        
        
        }else{
        
        }
    }else{
        echo 'error';
    }
?>