<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
require_once('connect.php');


$codigo_parte = $_POST['codigo_parte'];



$sql = "SELECT archivo FROM tb_fotos_partes_accidentes WHERE codigo = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $codigo_parte);
$stmt->execute();
$result = $stmt->get_result();

$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row['archivo'];
}

$stmt->close();
$con->close();

echo json_encode($files);
?>
