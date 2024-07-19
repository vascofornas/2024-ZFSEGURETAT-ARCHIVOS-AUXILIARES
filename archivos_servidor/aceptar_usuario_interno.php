<?php
header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $id = $_POST['id'];   
        $ti = $_POST['ti']; 
        $gi = $_POST['gi'];  

        date_default_timezone_set('Europe/Madrid');
        $date = date('Y-m-d H:i');        

        //creamos usuario en tb_usuarios_internos

        $get_result = $con->query("
            INSERT INTO tb_usuarios_internos (
                id_usuario,
                id_tipo_interno,
                id_grupo_interno,
                fecha_alta,
                fecha_baja,
                fecha_actualizacion) 
            VALUES (
                '".$id."',
                '".$ti."',
                '".$gi."',
                '".$date."',
                '".$date."',
                '".$date."'
            )
            "); 

            //cambiamos el tipo usuario en tb_usuarios
 
        if($get_result === true){
            echo "usuario interno aceptado";

             $get_result = $con->query("
                  UPDATE tb_usuarios SET tipo_usuario = 1 WHERE id = '".$id."'");
          
                    if($get_result === true){
                    echo "usuario interno aceptado";


                    //insertamos al usuario y grupo en tb_internos_grupos

                    $get_result = $con->query("
                        INSERT INTO tb_internos_grupos (
                            id_usuario,
                             id_grupo) 
                       VALUES (
                         '".$id."',
            
                         '".$gi."')
            "); 
            if($get_result === true){
                echo "usuario interno creado en internos grupos";

                //eliminamos el usuario de la tb_usuarios_visitantes
                $get_result = $con->query("
                  DELETE FROM tb_usuarios_externos  WHERE id_usuario= '".$id."'");

                if($get_result === true){
                    echo "usuario interno eliminado de usuarios visitantes";
                }



            }







          }





        
        
        }else{
       // echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>