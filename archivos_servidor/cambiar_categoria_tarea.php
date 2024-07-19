<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_categorias_tareas SET categoria = '".$categoria."' WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Categoria actualizada";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>