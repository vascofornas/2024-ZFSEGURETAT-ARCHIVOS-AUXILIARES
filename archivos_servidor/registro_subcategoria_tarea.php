<?php
 header("Access-Control-Allow-Origin: *");
 require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $subcategoria = $_POST['subcategoria'];
        $id_categoria = $_POST['id_categoria'];   
        
        $get_result = $con->query("INSERT INTO tb_subcategoria_tareas  (id_categoria, subcategoria) VALUES ('".$id_categoria."' ,'".$subcategoria."')"); 
 
        if($get_result === true){
        echo "OK";
        
        
        }else{
        
        }
    }else{
        echo 'error';
    }
?>