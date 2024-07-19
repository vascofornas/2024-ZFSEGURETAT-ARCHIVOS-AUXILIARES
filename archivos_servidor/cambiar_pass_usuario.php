<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST['email'];
        $pass = $_POST['pass'];   
        
        $encrypted_password = password_hash($pass, PASSWORD_DEFAULT);

        $get_result = $con->query("UPDATE tb_usuarios SET  encrypted_password='".$encrypted_password."'  WHERE email= '".$email."'"); 
 
        if($get_result === true){
        echo "OK";
        $detalle = "User changes profile email";
        
        }else{
        
        }
    }else{
        echo 'error';
    }
?>