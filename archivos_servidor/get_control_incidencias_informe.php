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
	return;
}

$turno = $_GET['turno'];



$sql = "SELECT 
    diario.id as id,
    diario.fecha_control_incidencias as fecha_control_incidencias,
    diario.responsable as responsable,
    diario.turno as turno,
    diario.codigo_turno as codigo_turno,
    diario.aviso_mantenimiento as aviso_mantenimiento,
    diario.aviso_policia as aviso_policia,
    diario.km_inicio as km_inicio,
    diario.km_final as km_final,
    diario.km_totales as km_totales,
    diario.robos as robos,
    diario.rondas as rondas,
    diario.alarmas as alarmas,
    diario.accidentes as accidentes

FROM tb_control_incidencias diario

WHERE diario.codigo_turno = '".$turno."'

ORDER BY diario.fecha_control_incidencias DESC  
LIMIT 1
";

$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		array_push($response,$row);
	}
	$conn->close;
header('Content-Type: application/json');
echo json_encode($response);
}
else {
	echo "vacio";
}
		


			

		

?>