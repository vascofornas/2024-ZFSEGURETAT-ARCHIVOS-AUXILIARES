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

$fecha = $_GET['fecha'];


$sql = "SELECT 
suceso.id as id,
suceso.titulo as titulo,
suceso.fecha_suceso as fecha_suceso,
suceso.responsable as responsable,
suceso.latitud as latitud,
suceso.longitud as longitud,
suceso.calle as calle,
usuario.nombre as nombre,
usuario.apellidos as apellidos,
suceso.descripcion as descripcion

FROM tb_sucesos suceso

LEFT JOIN tb_usuarios usuario ON suceso.responsable = usuario.id

WHERE DATE(suceso.fecha_suceso) =  '".$fecha."' 



 

ORDER BY suceso.fecha_suceso 

 




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