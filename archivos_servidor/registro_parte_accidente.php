<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $fecha_parte = $_POST['fecha_parte'];
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
        $firma_resp = $_POST['firma_resp'];
        $firma_cond = $_POST['firma_cond'];

        $turno = $_POST['turno'];
        $codigoturno = $_POST['codigoturno'];
        $patrulla = $_POST['patrulla'];
        $vigilante1 = $_POST['vigilante1'];
        $vigilante2 = $_POST['vigilante2'];
        $responsableservicio = $_POST['responsableservicio'];
        
         
        
        $get_result = $con->query("INSERT INTO 
        tb_partes_accidentes 
        (
        fecha_parte,
        responsable,
        descripcion,
        lugar_accidente,
        cat_vehiculo,
        frente_empresa,
        matricula,
        nacionalidad,
        marca_modelo,
        color,
        conductor_nombre,
        conductor_permiso,
        conductor_fecha_exp,
        conductor_direccion,
        conductor_ciudad,
        conductor_pais,
        conductor_tel,
        prop_nombre,
        prop_permiso,
        prop_fecha_exp,
        prop_direccion,
        prop_ciudad,
        prop_pais,
        prop_tel,
        cia_seguro,
        poliza,
        validez,
        titular,
        seguro_direccion,
        seguro_ciudad,
        seguro_pais,
        seguro_tel,
        apreciacion,
        intervencion,
        se_niega,
        turno,
        codigoturno,
        patrulla,
        vigilante1,
        vigilante2,
        responsableservicio,
        firma_resp,
        firma_cond
        
) 
        VALUES (
            '".$fecha_parte."',
             '".$responsable."',
             '".$descripcion."',
            '".$lugar_accidente."',
            '".$cat_vehiculo."',
            '".$frente_empresa."',
            '".$matricula."',
            '".$nacionalidad."',
            '".$marca_modelo."',
            '".$color."',
            '".$conductor_nombre."',
            '".$conductor_permiso."',
            '".$conductor_fecha_exp."',
            '".$conductor_direccion."',
            '".$conductor_ciudad."',
            '".$conductor_pais."',
            '".$conductor_tel."',
            '".$prop_nombre."',
            '".$prop_permiso."',
            '".$prop_fecha_exp."',
            '".$prop_direccion."',
            '".$prop_ciudad."',
            '".$prop_pais."',
            '".$prop_tel."',
            '".$cia_seguro."',
            '".$poliza."',
            '".$validez."',
            '".$titular."',
            '".$seguro_direccion."',
            '".$seguro_ciudad."',
            '".$seguro_pais."',
            '".$seguro_tel."',
            '".$apreciacion."',
            '".$intervencion."',
            '".$se_niega."',
            '".$turno."',
            '".$codigoturno."',
            '".$patrulla."',
            '".$vigilante1."',
            '".$vigilante2."',
            '".$responsableservicio."',
            '".$firma_resp."',
            '".$firma_cond."'
            
          
          ) "); 
 
        if($get_result === true){
        echo "OK";
       
        
        }else{
        echo $username." Error actualizando parte de accidente";
        }
    }else{
        echo 'error';
    }
?>