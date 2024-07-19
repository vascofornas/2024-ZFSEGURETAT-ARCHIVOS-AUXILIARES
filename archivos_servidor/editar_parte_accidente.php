<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
       
        $responsable = $_POST['responsable']; 
        $descripcion = $_POST['descripcion'];
        $lugar_accidente = $_POST['lugar_accidente']; 
        $cat_vehiculo = $_POST['cat_vehiculo'];
        $frente_empresa = $_POST['frente_empresa'];
        $matricula = $_POST['matricula'];
        $nacionalidad = $_POST['nacionalidad'];
        $marca_modelo = $_POST['marca_modelo'];
        $color = $_POST['color'];
        $conductor_nombre = $_POST['conductor_nombre'];
        $conductor_permiso = $_POST['conductor_permiso'];
        $conductor_fecha_exp = $_POST['conductor_fecha_exp'];
        $conductor_direccion = $_POST['conductor_direccion'];
        $conductor_ciudad = $_POST['conductor_ciudad'];
        $conductor_pais = $_POST['conductor_pais'];
        $conductor_tel = $_POST['conductor_tel'];
        $prop_nombre = $_POST['prop_nombre'];
        $prop_permiso = $_POST['prop_permiso'];
        $prop_fecha_exp = $_POST['prop_fecha_exp'];
        $prop_direccion = $_POST['prop_direccion'];
        $prop_ciudad = $_POST['prop_ciudad'];
        $prop_pais = $_POST['prop_pais'];
        $prop_tel = $_POST['prop_tel'];
        $cia_seguro = $_POST['cia_seguro'];
        $poliza = $_POST['poliza'];
        $validez = $_POST['validez'];
        $titular = $_POST['titular'];
        $seguro_direccion = $_POST['seguro_direccion'];
        $seguro_ciudad = $_POST['seguro_ciudad'];
        $seguro_pais = $_POST['seguro_pais'];
        $seguro_tel = $_POST['seguro_tel'];
        $apreciacion = $_POST['apreciacion'];
        $intervencion = $_POST['intervencion'];
        $se_niega = $_POST['se_niega'];
        $id = $_POST['id'];

        
        
         
        
        $get_result = $con->query("UPDATE 
        tb_partes_accidentes SET
        
        descripcion = '".$descripcion."',
        lugar_accidente = '".$lugar_accidente."',
        cat_vehiculo = '".$cat_vehiculo."',
        frente_empresa = '".$frente_empresa."',
        matricula = '".$matricula."',
        nacionalidad = '".$nacionalidad."',
        marca_modelo = '".$marca_modelo."',
        color = '".$color."',
        conductor_nombre = '".$conductor_nombre."',
        conductor_permiso = '".$conductor_permiso."',
        conductor_fecha_exp =  '".$conductor_fecha_exp."',
        conductor_direccion = '".$conductor_direccion."',
        conductor_ciudad = '".$conductor_ciudad."',
        conductor_pais = '".$conductor_pais."',
        conductor_tel = '".$conductor_tel."',
        prop_nombre = '".$prop_nombre."',
        prop_permiso = '".$prop_permiso."',
        prop_fecha_exp = '".$prop_fecha_exp."',
        prop_direccion = '".$prop_direccion."',
        prop_ciudad = '".$prop_ciudad."',
        prop_pais = '".$prop_pais."',
        prop_tel = '".$prop_tel."',
        cia_seguro = '".$cia_seguro."',
        poliza =  '".$poliza."',
        validez = '".$validez."',
        titular = '".$titular."',
        seguro_direccion = '".$seguro_direccion."',
        seguro_ciudad = '".$seguro_ciudad."',
        seguro_pais = '".$seguro_pais."',
        seguro_tel = '".$seguro_tel."',
        apreciacion = '".$apreciacion."',
        intervencion = '".$intervencion."',
        se_niega = '".$se_niega."'
        WHERE id = '".$id."'
         "); 
 
        if($get_result === true){
        echo "OK";
       
        
        }else{
        echo $username." Error actualizando foto de usuario";
        }
    }else{
        echo 'error';
    }
?>