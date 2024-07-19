<?php
header("Access-Control-Allow-Origin: *");
$servername = "localhost";
$username = "zfseguretat";
$password = "g9hr#+-_awnoA";
$dbname = "zfbarcelona_zfseguretat";


//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
//check connecion
//$usuario = 62;
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
	
}

$codigoturno = $_GET['codigoturno'];



$sql = "SELECT 
informe.id as id,
informe.fecha_verificacion as fecha_verificacion,
informe.responsable as responsable,
informe.turnoservicio as turnoservicio,
informe.vigilanteservicio as vigilanteservicio,
informe.responsableservicio as responsableservicio,
informe.codigoturno as codigoturno, 
informe.patrulla as patrulla,
informe.firma_resp as firma_resp,
informe.firma_resp2 as firma_resp2,
informe.vehiculo as vehiculo,
informe.matricula_vehiculo as matricula_vehiculo,
informe.vehiculo_sustitucion as vehiculo_sustitucion,
informe.matricula_sustitucion as matricula_sustitucion,
informe.turno as turno,
informe.conductor_1 as conductor_1,
informe.conductor_2 as conductor_2,
informe.conductor_1_canero as conductor_1_canero,
informe.conductor_2_canero as conductor_2_canero,
informe.llaves as llaves,
informe.marcador as marcador,
informe.movil as movil,
informe.documentacion as documentacion,
informe.emisora as emisora,
informe.electricidad as electricidad,
informe.cintaczf cintaczf,
informe.sepiolita sepiolita,
informe.camara as camara,
informe.walkies as walkies,
informe.conos as conos,
informe.equipo_aire as equipo_aire,
informe.botiquin as botiquin, 
informe.extintor as extintor, 
informe.maletinleds as maletinleds, 
informe.baston as baston, 
informe.dea as dea,
informe.linternas as linternas, 
informe.cizalla as cizalla, 
informe.km_salida as km_salida, 
informe.km_llegada as km_llegada,
informe.km_totales as km_totales,
informe.km_salida_sust as km_salida_sust,
informe.km_llegada_sust as km_llegada_sust,
informe.km_totales_sust as km_totales_sust,
informe.km_repostaje as km_repostaje,
informe.km_repostaje_sust as km_repostaje_sust,
informe.litros as litros,
informe.dinero as dinero,
informe.litros_ad as litros_ad,
informe.dinero_ad as dinero_ad,
informe.gasoil as gasoil,
informe.adblue as adblue,
informe.observaciones as observaciones

FROM tb_verificacion_vehiculos informe

LEFT JOIN tb_usuarios usuario ON informe.responsable = usuario.id

WHERE informe.codigoturno = '".$codigoturno."'

ORDER BY informe.fecha_verificacion desc
 ";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		array_push($response,$row);
	}
	
header('Content-Type: application/json');
echo json_encode($response);
}
else {
	echo "vacio";
}
		


			

		

?>