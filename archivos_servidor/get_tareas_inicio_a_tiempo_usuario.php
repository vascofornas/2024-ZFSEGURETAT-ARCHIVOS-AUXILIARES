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
tarea.id as id,
tarea.usuario_asignado as usuario_asignado_id,
users.nombre as usuario_asignado_nombre,
users.apellidos as usuario_asignado_apellidos,
users.email as usuario_asignado_email,
tarea.descripcion as descripcion,
tarea.latitud as latitud,
tarea.longitud as longitud,
tarea.ubicacion as ubicacion,
tarea.titulo as titulo,
tarea.edificio as edificio,
tarea.planta as planta,
tarea.estancia as estancia,
tarea.categoria as categoria_id,
categoria.categoria as categoria_categoria,
tarea.subcategoria as subcategoria_id,
subcategoria.subcategoria as subcategoria_subcategoria,
tarea.tipo as tipo_id,
tipo.tipo as tipo_tipo,
tarea.fecha_hora_vencimiento as fecha_hora_vencimiento,
tarea.fecha_hora_inicio_programada as fecha_hora_inicio_programada,
tarea.fecha_hora_inicio_efectiva as fecha_hora_inicio_efectiva,
tarea.fecha_hora_fin as fecha_hora_fin,
tarea.expediente as expediente_id,
exp.titulo as expediente_titulo,
tarea.asignada_a_usuario as asignada_a_usuario,
tarea.asignada_a_grupo as asignada_a_grupo,
tarea.grupo as grupo_id,
grupo.grupo_int as grupo_int,
tarea.estado as estado_id,
estado.estado as estado_estado


FROM tb_tareas tarea

LEFT JOIN tb_usuarios_internos userint ON tarea.usuario_asignado = userint.id_usuario
LEFT JOIN tb_usuarios users ON users.id = userint.id_usuario
LEFT JOIN tb_categorias_tareas categoria ON categoria.id = tarea.categoria
LEFT JOIN tb_subcategoria_tareas subcategoria ON subcategoria.id = tarea.subcategoria
LEFT JOIN tb_tipos_tareas tipo ON tipo.id = tarea.tipo
LEFT JOIN tb_expedientes exp ON exp.id = tarea.expediente
LEFT JOIN tb_grupos_internos grupo ON grupo.id = tarea.grupo
LEFT JOIN tb_estados_tareas estado ON estado.id = tarea.estado

WHERE tarea.fecha_hora_vencimiento > DATE(NOW() - INTERVAL 7 DAY)  AND tarea.fecha_hora_vencimiento <= DATE(NOW()) AND tarea.estado = 2 

ORDER BY tarea.usuario_asignado, tarea.grupo




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