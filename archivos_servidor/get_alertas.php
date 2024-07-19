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
alerta.id as id,
alerta.id_usuario as id_usuario,
alerta.id_tipo_alerta as id_tipo_alerta,
alerta.latitud as latitud,
alerta.longitud as longitud,
alerta.descripcion as descripcion,
alerta.estado as estado,
alerta.fecha as fecha,
alerta.leida as leida,
tip.tipo_alerta as tipo_alerta


FROM tb_alertas alerta

LEFT JOIN tb_tipos_alertas tip ON alerta.id_tipo_alerta = tip.id

ORDER by alerta.fecha 




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