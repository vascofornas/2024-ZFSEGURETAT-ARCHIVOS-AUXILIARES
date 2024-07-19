<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';
//include_once("funciones.php");
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['codigo'])) {

    // receiving the post params
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];

    // get the user by email and password
    $user = $db->envioEmailCodigoPass($email, $codigo);

}