<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_categoria = $_POST['id_categoria'];
        $subcategoria = $_POST['subcategoria'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_subcategoria_tareas SET id_categoria = '".$id_categoria."', 
        subcategoria = '".$subcategoria."'
         WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "SubCategoria actualizada";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>