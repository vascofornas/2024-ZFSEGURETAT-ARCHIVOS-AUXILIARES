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


$patrulla = $_GET['patrulla'];


$sql = "SELECT 
abandonados.id as id,
abandonados.fecha_abandonados as fecha_abandonados,
abandonados.responsable as responsable,
abandonados.turno as turno,
abandonados.tipo as tipo,
abandonados.matricula as matricula,
abandonados.modelo as modelo,
abandonados.color as color,
abandonados.patrulla as patrulla,
abandonados.direccion as direccion,
abandonados.enganx_groga as enganx_groga,
abandonados.enganx_verda as enganx_verda,
abandonados.denuncia as denuncia,
abandonados.observaciones as observaciones

FROM tb_vehiculos_abandonados abandonados

LEFT JOIN tb_usuarios usuario ON abandonados.responsable = usuario.id





ORDER BY abandonados.fecha_abandonados 

 




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