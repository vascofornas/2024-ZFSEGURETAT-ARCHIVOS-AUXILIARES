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
informe.responsable as responsable

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