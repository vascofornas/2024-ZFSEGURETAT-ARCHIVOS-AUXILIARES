<?php
header("Access-Control-Allow-Origin: *");
require_once('connect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $te = $_POST['te'];


    date_default_timezone_set('Europe/Madrid');
    $date = date('Y-m-d H:i');



    //cambiamos el tipo usuario en tb_usuarios_externos


    $get_result = $con->query("UPDATE tb_usuarios_externos SET 
                  id_tipo_ext = '".$te."',
                  fecha_alta = '".$date."',
                  fecha_baja = '".$date."',
                  fecha_actualizacion = '".$date."'

                  WHERE id_usuario = '".$id."' ");

    if ($get_result === true) {
        echo "usuario externo aceptado";
    }
} else {
    echo 'error';
}
