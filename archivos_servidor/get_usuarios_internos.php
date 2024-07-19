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
user.id as id,
user.email as email,
user.imagen as imagen,
user.nombre as nombre,
user.apellidos as apellidos,
tipoint.tipo_int as tipo_nombre,
tipoint.id as tipo_id,
userint.fecha_alta as fecha_alta, 
userint.fecha_baja as fecha_baja, 
userint.fecha_actualizacion as fecha_actualizacion, 
GROUP_CONCAT(grupoint.id) grupos_id,
GROUP_CONCAT(grupoint.grupo_int) grupos_nombres

FROM tb_usuarios user



LEFT JOIN tb_usuarios_internos userint on userint.id_usuario = user.id


LEFT JOIN tb_tipos_internos tipoint on tipoint.id= userint.id_tipo_interno


LEFT JOIN tb_grupos_internos grupoint ON grupoint.id= userint.id_grupo_interno 




WHERE user.tipo_usuario = 1

GROUP BY userint.id

ORDER BY user.email




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