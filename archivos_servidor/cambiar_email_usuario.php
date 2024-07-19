<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST['email'];
        $id = $_POST['id'];   
        
        $get_result = $con->query("UPDATE tb_usuarios SET  email='".$email."' , verificada = 0 WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "Email del usuario actualizado";
        $detalle = "User changes profile email";
        
        }else{
        
        }
    }else{
        echo 'error';
    }
?>