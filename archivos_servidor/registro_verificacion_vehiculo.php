<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['fecha_verificacion'])) {

    // receiving the post params
    
   
  
    $fecha_verificacion = $_POST['fecha_verificacion'];
    $responsable = $_POST['responsable'];
    $turnoservicio = $_POST['turnoservicio'];
    $vigilanteservicio = $_POST['vigilanteservicio'];
    $responsableservicio = $_POST['responsableservicio'];
    $codigoturno = $_POST['codigoturno'];
    $patrulla = $_POST['patrulla'];
    $firma_resp = $_POST['firma_resp'];
    $firma_resp2 = $_POST['firma_resp2'];
    $vehiculo = $_POST['vehiculo'];
    $matricula_vehiculo = $_POST['matricula_vehiculo'];
    $vehiculo_sustitucion = $_POST['vehiculo_sustitucion'];
    $matricula_sustitucion = $_POST['matricula_sustitucion'];
    $turno = $_POST['turno'];
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
            
    
    

 


   
    $suceso = $db->storeVerificacionVehiculo(
    
        $fecha_verificacion,
        $responsable,
        $turnoservicio,
        $vigilanteservicio,
        $responsableservicio,
        $codigoturno,
        $patrulla,
        $firma_resp,
        $firma_resp2,
        $vehiculo,
        $matricula_vehiculo,
        $vehiculo_sustitucion,
        $matricula_sustitucion,
        $turno,
        $conductor_1,
        $conductor_2,
        $conductor_1_canero,
        $conductor_2_canero,
        $llaves,
        $marcador,
        $movil,
        $documentacion,
        $emisora ,
        $electricidad ,
        $cintaczf ,
        $sepiolita ,
        $camara ,
        $walkies,
        $conos,
        $equipo_aire,
        $botiquin, 
        $extintor, 
        $maletinleds, 
        $baston, 
        $dea,
        $linternas, 
        $cizalla, 
        $km_salida, 
        $km_llegada,
        $km_totales,
        $km_salida_sust,
        $km_llegada_sust,
        $km_totales_sust,
        $km_repostaje,
        $km_repostaje_sust,
        $litros,
        $dinero,
        $litros_ad,
        $dinero_ad,
        $gasoil,
        $adblue,
        $observaciones 

    );

    if ($suceso != false) {
        // aviso is created
       // $response["error"] = FALSE;
        $response["informe"]["id"] = $suceso["id"];
        $response["informe"]["fecha_verificacion"] = $suceso["fecha_verificacion"];
        $response["informe"]["responsable"] = $suceso["responsable"];
   
    
       $response["error"] = FALSE;
       echo json_encode( $response, JSON_UNESCAPED_UNICODE );

    } else {
        // aviso is not created
        $response["error"] = TRUE;
        $response["error_msg"] = "Datos incorrectos";
        echo json_encode( $response, JSON_UNESCAPED_UNICODE );
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Faltan datos";
    echo json_encode( $response, JSON_UNESCAPED_UNICODE );
}
?>
