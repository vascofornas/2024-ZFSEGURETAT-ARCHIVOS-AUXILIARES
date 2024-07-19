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

$idcat =  $_GET['idcat'];


$sql = "SELECT 
subcat.id as id,
subcat.id_categoria as id_categoria,
subcat.subcategoria as subcategoria,
cat.categoria as categoria

FROM tb_subcategoria_tareas subcat
LEFT JOIN tb_categorias_tareas cat ON subcat.id_categoria = cat.id

WHERE subcat.id_categoria = '".$idcat."' 

ORDER BY subcat.subcategoria






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