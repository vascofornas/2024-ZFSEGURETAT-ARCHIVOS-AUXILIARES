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
diario.fecha_diario as fecha_diario,
diario.responsable as responsable,
diario.descripcion as descripcion,
diario.turno as turno

FROM tb_diario diario

LEFT JOIN tb_usuarios usuario ON diario.responsable = usuario.id

WHERE  diario.turno = '".$turno."'



 

ORDER BY diario.fecha_diario 

 




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