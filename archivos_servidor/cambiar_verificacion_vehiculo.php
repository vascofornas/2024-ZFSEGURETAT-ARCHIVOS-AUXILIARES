<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
       
        $id = $_POST['id'];
        $fecha_verificacion = $_POST['fecha_verificacion'];
   
    $firma_resp = $_POST['firma_resp'];
    $firma_resp2 = $_POST['firma_resp2'];
    $vehiculo = $_POST['vehiculo'];
    $matricula_vehiculo = $_POST['matricula_vehiculo'];
    $vehiculo_sustitucion = $_POST['vehiculo_sustitucion'];
    $matricula_sustitucion = $_POST['matricula_sustitucion'];
    $conductor_1 = $_POST['conductor_1'];
    $conductor_2 = $_POST['conductor_2'];
    $conductor_1_canero = $_POST['conductor_1_canero'];
    $conductor_2_canero = $_POST['conductor_2_canero'];
    $llaves = $_POST['llaves'];
    $marcador = $_POST['marcador'];
    $movil = $_POST['movil'];
    $documentacion = $_POST['documentacion'];
    $emisora = $_POST['emisora'];
    $electricidad = $_POST['electricidad'];
    $cintaczf = $_POST['cintaczf'];
    $sepiolita = $_POST['sepiolita'];
      $camara = $_POST['camara'];
        $walkies = $_POST['walkies'];
          $conos = $_POST['conos'];
          $equipo_aire = $_POST['equipo_aire'];
          $botiquin = $_POST['botiquin'];
          $extintor = $_POST['extintor'];
          $maletinleds = $_POST['maletinleds'];
          $baston = $_POST['baston'];
          $dea = $_POST['dea'];
          $linternas = $_POST['linternas'];
          $cizalla = $_POST['cizalla'];
          $km_salida = $_POST['km_salida'];
          $km_llegada = $_POST['km_llegada'];
          $km_totales = $_POST['km_totales'];
          $km_salida_sust = $_POST['km_salida_sust'];
          $km_llegada_sust = $_POST['km_llegada_sust'];
          $km_totales_sust = $_POST['km_totales_sust'];
          $km_repostaje = $_POST['km_repostaje'];
          $km_repostaje_sust = $_POST['km_repostaje_sust'];
          $litros = $_POST['litros'];
          $dinero = $_POST['dinero'];
          $litros_ad = $_POST['litros_ad'];
          $dinero_ad = $_POST['dinero_ad'];
          $gasoil = $_POST['gasoil'];
          $adblue = $_POST['adblue'];
          $observaciones = $_POST['observaciones']; 

        $get_result = $con->query("UPDATE 
        tb_verificacion_vehiculos 
        SET 
        fecha_verificacion ='".$fecha_verificacion."',
        firma_resp ='".$firma_resp."',
        firma_resp2 ='".$firma_resp2."',
        vehiculo ='".$vehiculo."',
        matricula_vehiculo ='".$matricula_vehiculo."',
        vehiculo_sustitucion ='".$vehiculo_sustitucion."',
        matricula_sustitucion ='".$matricula_sustitucion."',
        conductor_1 ='".$conductor_1."',
        conductor_2 ='".$conductor_2."',
        conductor_1_canero ='".$conductor_1_canero."',
        conductor_2_canero ='".$conductor_2_canero."',
        llaves ='".$llaves."',
        marcador ='".$marcador."',
        movil ='".$movil."',
        documentacion ='".$documentacion."',
        emisora ='".$emisora."',
        electricidad ='".$electricidad."',
        cintaczf ='".$cintaczf."',
        sepiolita ='".$sepiolita."',
        camara ='".$camara."',
        walkies ='".$walkies."',
        conos ='".$conos."',
        equipo_aire ='".$equipo_aire."',
        botiquin ='".$botiquin."',
        extintor ='".$extintor."',
        maletinleds ='".$maletinleds."',
        baston ='".$baston."',
        dea ='".$dea."',
        linternas ='".$linternas."',
        cizalla ='".$cizalla."',
        km_salida ='".$km_salida."',
        km_llegada ='".$km_llegada."',
        km_totales ='".$km_totales."',
        km_salida_sust ='".$km_salida_sust."',
        km_llegada_sust ='".$km_llegada_sust."',
        km_totales_sust ='".$km_totales_sust."',
        km_repostaje ='".$km_repostaje."',
        km_repostaje_sust ='".$km_repostaje_sust."',
        litros ='".$litros."',
        dinero ='".$dinero."',
        litros_ad ='".$litros_ad."',
        dinero_ad ='".$dinero_ad."',
        gasoil ='".$gasoil."',
        adblue ='".$adblue."',
        observaciones ='".$observaciones."'
       
        
        
        WHERE id= '".$id."'"); 
 
        if($get_result === true){
        echo "verificacion vehiculo actualizada";
        $detalle = "User changes profile name";
        
        }else{
        echo $username." Error actualizando nombre de usuario";
        }
    }else{
        echo 'error';
    }
?>