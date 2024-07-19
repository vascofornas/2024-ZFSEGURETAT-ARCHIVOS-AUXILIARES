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
expediente.id as id,
expediente.titulo as titulo,
expediente.estado as estado,
expediente.fecha_apertura as fecha_apertura,
expediente.fecha_cierre as fecha_cierre,
expediente.responsable as responsable,
expediente.tipo as tipo,
expediente.latitud as latitud,
expediente.longitud as longitud,
expediente.calle as calle,
usuario.nombre as nombre,
usuario.apellidos as apellidos,
usuario.email as email,
expediente.tituloedit as tituloedit,
expediente.descripcion as descripcion

FROM tb_expedientes expediente
LEFT JOIN tb_usuarios usuario ON expediente.responsable = usuario.id

WHERE expediente.estado = 'Cerrado' AND expediente.tipo = 'Accidentes con terceros'



 

ORDER BY fecha_apertura DESC

 




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