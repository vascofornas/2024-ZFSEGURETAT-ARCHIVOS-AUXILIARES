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
alumbrado.id as id,
alumbrado.fecha_alumbrado as fecha_alumbrado,
alumbrado.responsable as responsable,
alumbrado.observaciones as observaciones,
alumbrado.turno as turno,
alumbrado.c_A_1 as c_A_1,
alumbrado.c_A_2 as c_A_2,
alumbrado.c_B_1 as c_B_1,
alumbrado.c_B_2 as c_B_2,
alumbrado.c_C_2 as c_C_2,
alumbrado.c_D_2 as c_D_2,
alumbrado.c_E_2 as c_E_2,
alumbrado.c_E_3 as c_E_3,
alumbrado.c_E_3 as c_E_3,
alumbrado.c_F_3 as c_F_3,
alumbrado.c_H_2 as c_H_2,
alumbrado.c_K_3 as c_K_3,
alumbrado.c_L_3 as c_L_3,
alumbrado.c_M_3 as c_M_3,
alumbrado.c_Z_1 as c_Z_1,
alumbrado.c_1_1 as c_1_1,
alumbrado.c_2_1 as c_2_1,
alumbrado.c_3_1 as c_3_1,
alumbrado.c_3_2 as c_3_2,
alumbrado.c_4_2 as c_4_2,
alumbrado.c_4_3 as c_4_3,
alumbrado.c_5_2 as c_5_2,
alumbrado.c_6_2 as c_6_2,
alumbrado.c_6_3 as c_6_3,
alumbrado.c_11_3 as c_11_3,
alumbrado.c_40_1 as c_40_1,
alumbrado.c_40_2 as c_40_2,
alumbrado.c_40_3 as c_40_3,
alumbrado.c_41_1 as c_41_1,
alumbrado.c_41_2 as c_41_2,
alumbrado.c_41_3 as c_41_3,
alumbrado.c_42_1 as c_42_1,
alumbrado.c_42_2 as c_42_2,
alumbrado.c_42_3 as c_42_3,
alumbrado.c_43_1 as c_43_1,
alumbrado.c_43_2 as c_43_2,
alumbrado.c_43_3 as c_43_3,
alumbrado.c_50_1 as c_50_1,
alumbrado.c_50_2 as c_50_2,
alumbrado.c_50_3 as c_50_3,
alumbrado.c_60_1 as c_60_1,
alumbrado.c_60_2 as c_60_2,
alumbrado.c_60_3 as c_60_3,
alumbrado.c_61_1 as c_61_1,
alumbrado.c_61_2 as c_61_2,
alumbrado.c_61_3 as c_61_3,
alumbrado.c_62_1 as c_62_1,
alumbrado.c_62_2 as c_62_2,
alumbrado.c_62_3 as c_62_3,
alumbrado.c_F_llarga_1 as c_F_llarga_1,
alumbrado.c_F_llarga_2 as c_F_llarga_2,
alumbrado.c_F_llarga_3 as c_F_llarga_3,
alumbrado.c_Motors_1 as c_Motors_1,
alumbrado.c_Motors_2 as c_Motors_2,
alumbrado.c_Motors_3 as c_Motors_3,
alumbrado.c_Enll_1 as c_Enll_1,
alumbrado.c_Enll_2 as c_Enll_2,
alumbrado.c_Enll_3 as c_Enll_3,
alumbrado.firma1 as firma1,
alumbrado.firma2 as firma2

FROM tb_alumbrado alumbrado

LEFT JOIN tb_usuarios usuario ON alumbrado.responsable = usuario.id

WHERE  alumbrado.turno = '".$turno."'



 

ORDER BY alumbrado.fecha_alumbrado 

 




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