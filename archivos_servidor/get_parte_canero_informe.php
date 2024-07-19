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
    diario.fecha_parte_canero as fecha_parte_canero,
    diario.responsable as responsable,
    diario.turno as turno,
    diario.codigo_turno as codigo_turno,
    diario.canero as canero,
    diario.can as can,
    diario.perrera as perrera,
    diario.bebedero as bebedero,
    diario.correa as correa,
    diario.collar as collar,
    diario.bozal as bozal,
    diario.arnes as arnes,
    diario.documentacion as documentacion,
    diario.pienso as pienso,
    diario.observaciones as observaciones,
    diario.firma as firma

FROM tb_parte_canero diario

WHERE diario.codigo_turno = '".$turno."'

ORDER BY diario.fecha_parte_canero DESC  
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