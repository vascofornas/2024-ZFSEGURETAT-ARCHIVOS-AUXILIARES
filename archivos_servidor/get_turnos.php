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




$sql = "SELECT 
turno.id as id,
turno.responsableservicio as responsableservicio,
turno.patrulla as patrulla,
turno.vigilante1 as vigilante1,
turno.vigilante2 as vigilante2,
turno.inicio as inicio,
turno.turno as turno,
turno.estado as estado,
turno.codigo as codigo,
turno.firmaV1 as firmaV1,
turno.firmaV2 as firmaV2



FROM tb_turnos turno
ORDER BY turno.inicio 








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