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

$codigoturno = $_GET['codigoturno'];



$sql = "SELECT 
informe.id as id,
informe.fecha_incidencia as fecha_incidencia,
informe.responsable as responsable,
informe.descripcion as descripcion,
informe.descripcion2 as descripcion2,
informe.descripcion3 as descripcion3,
informe.descripcion4 as descripcion4,
informe.descripcion5 as descripcion5,
informe.descripcion6 as descripcion6,
informe.descripcion7 as descripcion7,
informe.descripcion8 as descripcion8,
informe.descripcion9 as descripcion9,
informe.descripcion10 as descripcion10,
informe.descripcion11 as descripcion11,
informe.descripcion12 as descripcion12,
informe.descripcion13 as descripcion13,
informe.descripcion14 as descripcion14,
informe.descripcion15 as descripcion15,
informe.descripcion16 as descripcion16,
informe.descripcion17 as descripcion17,
informe.descripcion18 as descripcion18,
informe.descripcion19 as descripcion19,
informe.descripcion20 as descripcion20,
informe.descripcion21 as descripcion21,
informe.descripcion22 as descripcion22,
informe.turnoservicio as turno_servicio,
informe.vigilanteservicio as vigilante_servicio,
informe.responsableservicio as responsable_servicio,
informe.titulo as titulo,
informe.codigo as codigo,
informe.codigoturno as codigoturno,
informe.patrulla as patrulla,
informe.numerofotos as numerofotos,
informe.firma_resp as firma_resp,
informe.firma_resp2 as firma_resp2,
COALESCE(GROUP_CONCAT(fotos_informes_incidencias.archivo), '') AS fotos_incidencias

FROM tb_informe_incidencias informe

LEFT JOIN tb_usuarios usuario ON informe.responsable = usuario.id
LEFT JOIN tb_fotos_informes_incidencias fotos_informes_incidencias ON informe.codigo = fotos_informes_incidencias.codigo

WHERE informe.codigoturno = '".$codigoturno."'

GROUP BY informe.id

ORDER BY informe.fecha_incidencia DESC;

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