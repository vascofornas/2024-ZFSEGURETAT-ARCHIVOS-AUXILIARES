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

$codigo = $_GET['codigo'];




$sql = "SELECT 
parte.id as id,
parte.fecha_parte as fecha_parte,
parte.responsable as responsable,
parte.descripcion as descripcion,
parte.lugar_accidente as lugar_accidente,
parte.cat_vehiculo as cat_vehiculo,
parte.frente_empresa as frente_empresa,
parte.matricula as matricula,
parte.nacionalidad as nacionalidad,
parte.marca_modelo as marca_modelo,
parte.color as color,
parte.conductor_nombre as conductor_nombre,
parte.conductor_permiso as conductor_permiso,
parte.conductor_fecha_exp as conductor_fecha_exp,
parte.conductor_direccion as conductor_direccion,
parte.conductor_ciudad as conductor_ciudad,
parte.conductor_pais as conductor_pais,
parte.conductor_tel as conductor_tel,
parte.prop_nombre as prop_nombre,
parte.prop_permiso as prop_permiso,
parte.prop_fecha_exp as prop_fecha_exp,
parte.prop_direccion as prop_direccion,
parte.prop_ciudad as prop_ciudad,
parte.prop_pais as prop_pais,
parte.prop_tel as prop_tel,
parte.cia_seguro as cia_seguro,
parte.poliza as poliza,
parte.validez as validez,
parte.titular as titular,
parte.seguro_direccion as seguro_direccion,
parte.seguro_ciudad as seguro_ciudad,
parte.seguro_pais as seguro_pais,
parte.seguro_tel as seguro_tel,
parte.apreciacion as apreciacion,
parte.intervencion as intervencion,
parte.se_niega as se_niega,
parte.turno as turno,
parte.codigoturno as codigoturno,
parte.codigo_parte as codigo_parte,
parte.patrulla as patrulla,
parte.vigilante1 as vigilante1,
parte.vigilante2 as vigilante2,
parte.responsableservicio as responsableservicio,
parte.firma_resp as firma_resp,
parte.firma_resp2 as firma_resp2,
parte.firma_cond as firma_cond


FROM tb_partes_accidentes parte

LEFT JOIN tb_usuarios usuario ON parte.responsable = usuario.id

WHERE parte.codigoturno =  '".$codigo."' 

ORDER BY parte.fecha_parte desc

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