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
farola.id as id,
farola.fecha_farola as fecha_farola,
farola.responsable as responsable,
farola.descripcion as descripcion,
farola.turno as turno,
farola.calle as calle,
farola.farola as farola,
farola.estado as estado,
informe.observaciones as observaciones
FROM 
tb_farolas farola
LEFT JOIN 
(SELECT * FROM tb_informe_alumbrado2 GROUP BY turno) informe 
ON farola.turno = informe.turno
LEFT JOIN 
tb_usuarios usuario ON farola.responsable = usuario.id
WHERE 
farola.turno = '".$turno."'
ORDER BY 
farola.fecha_farola;



 




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