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
aviso.id as id,
aviso.fecha_inicio as fecha_inicio,
aviso.fecha_fin as fecha_fin,
aviso.latitud as latitud,
aviso.longitud as longitud,
aviso.calle as calle,
aviso.descripcion as descripcion,
aviso.tipo_aviso as tipo_aviso,
aviso.activar_x_antes as activar_x_antes,
aviso.restringido_a as restringido_a,
aviso.diametro as diametro,
aviso.creado_por as creado_por,
aviso.titulo as titulo,
tip.tipo_aviso as tipo_nombre,
tip.color as tipo_color,
tip.simbolo as tipo_icono,
aviso.visibilidad as visibilidad

FROM tb_avisos aviso

LEFT JOIN tb_tipos_avisos tip ON aviso.tipo_aviso = tip.id

WHERE aviso.fecha_inicio <= NOW() AND aviso.fecha_fin >= NOW()




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