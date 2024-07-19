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
tip.tipo_usuario as tipo_usuario,
tipoext.tipo_ext as tipo_externo,
uext.fecha_alta as fecha_alta,
uext.fecha_baja as fecha_baja,
uext.fecha_actualizacion as fecha_actualizacion,
emp.id as id_empresa,
emp.nombre as empresa


FROM tb_usuarios user

LEFT JOIN tb_tipos_usuarios tip ON tip.id = user.tipo_usuario
LEFT JOIN tb_usuarios_externos uext ON uext.id_usuario = user.id
LEFT JOIN tb_tipos_externos tipoext ON uext.id_tipo_ext = tipoext.id
LEFT JOIN tb_empresas emp ON uext.empresa  = emp.id


WHERE user.tipo_usuario = 2 AND tipoext.id !=3

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