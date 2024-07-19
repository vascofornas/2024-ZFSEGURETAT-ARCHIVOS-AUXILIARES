<?php
header("Access-Control-Allow-Origin: *");
//REQUIRE PARA FUNCIONES DE PHPMAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


require 'connect.php';


//entrada de datos
global $id_aviso;
$id_aviso = $_POST['id_aviso'];
$fecha = $_POST['fecha_inicio'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$calle = $_POST['calle'];
$fecha_inicio = $_POST['fecha_inicio'];
$originalDate = $fecha_inicio;
$newDateI = date("d-m-Y H:i", strtotime($originalDate));

$fecha_fin = $_POST['fecha_fin'];
$originalDate = $fecha_fin;
$newDateF = date("d-m-Y H:i", strtotime($originalDate));

if($newDateF == "02-02-2042 02:22"){
    $newDateF = " ";

}
else {
    $newDateF = date("d-m-Y H:i", strtotime($originalDate));
}

$tipo_aviso =  $_POST['tipo_aviso'];
$activar_x_antes =  $_POST['activar_x_antes'];
$visibilidad =  $_POST['visibilidad'];
$restringido_a =  $_POST['restringido_a'];
$diametro =  $_POST['diametro'];
$latitud =  $_POST['latitud'];
$longitud =  $_POST['longitud'];

function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'kilometers') {
    $theta = $longitude1 - $longitude2; 
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
    $distance = acos($distance); 
    $distance = rad2deg($distance); 
    $distance = $distance * 60 * 1.1515; 
    switch($unit) { 
      case 'miles': 
        break; 
      case 'kilometers' : 
        $distance = $distance * 1.609344; 
    } 
    return (round($distance,2)); 
  }


function envia_email($receptor,$h1,$mensaje){


    //ENVIO EMAIL AL usuario
    $email = $receptor;
          
    
  
    $subject = "Nuevo aviso en ZFseguretat";
    
    $htmlContent = '
    <html>
    <head>
    <title>Nuevo aviso en ZFseguretat </title>
    </head>
    <body style="background-color: #ffffff; color:000 ;text-align: left">
    <img src="https://faro.red/zfseguretat/zf.png" alt="ZF" height="200" >
    
    <h1>'.$h1. ' </h1>
    
    
    <h4 style="background-color: #ffffff; color:#000000 ;text-align: left">'.$mensaje.'</h4>
    
    
    
    
    <h3 style="background-color: #ffffff; color:#000 ;text-align: left">Saludos cordiales</h3>
    <h3 style="background-color: #ffffff; color:#000 ;text-align: left">El equipo de ZFseguretat</h3>
    
    
    </body>
    </html>';
    
    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // Additional headers
    $email_superadmin = "evan.zero.faro.red@gmail.com";
    $headers .= 'From: ZF  App<evan.zero.faro.red@gmail.com>' . "\r\n";
    $headers .= 'Cc: '.$email_superadmin. "\r\n";
    /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
    $mail = new PHPMailer(TRUE);
    $mail->IsHTML(true);
    
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "evan.zero.faro.red@gmail.com";
    $mail->Password = "ccfxosiqsakcumit";
    
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    
    /* Open the try/catch block. */
    try {
     /* Set the mail sender. */
     $mail->setFrom('evan.zero.faro.red@gmail.com', 'Administrador de ZFseguretat');
    
     /* Add a recipient. */
    
     $mail->addAddress($email_superadmin, "Administrador de ZFseguretat");
     $mail->addAddress($email, $email);
    
     /* Set the subject. */
     $mail->Subject = $subject;
    
     /* Set the mail message body. */
     $mail->Body = $htmlContent;
    
     /* Finally send the mail. */
     $mail->send();
    }
    catch (Exception $e)
    {
     /* PHPMailer exception. */
     echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
     /* PHP exception (note the backslash to select the global namespace Exception class). */
     echo $e->getMessage();
    }
    
    // Send email
    if(1 ==1):
    $successMsg = 'Email enviado.';
    else:
    $errorMsg = 'Email sending fail.';
    endif;
    }



    //fin enviar email
        
    
//capturamos los datos del tipo aviso


$stmtp = $con->prepare("SELECT * FROM tb_tipos_avisos WHERE id = ? LIMIT 1");
$stmtp->bind_param("i", $tipo_aviso);
$stmtp->execute();
$result = $stmtp->get_result();
$row = $result->fetch_assoc();
$tipo_de_aviso = $row['tipo_aviso'];

//capturamos la id del autor del aviso
$stmtp = $con->prepare("SELECT * FROM tb_avisos WHERE id = ? LIMIT 1");
$stmtp->bind_param("i", $id_aviso);
$stmtp->execute();
$result = $stmtp->get_result();
$row = $result->fetch_assoc();
$autor = $row['creado_por'];

//capturamos el email del del creador
$stmtpi = $con->prepare("SELECT * FROM tb_usuarios WHERE id = ? LIMIT 1");
$stmtpi->bind_param("i", $autor);
$stmtpi->execute();
$result = $stmtpi->get_result();
$row = $result->fetch_assoc();
$email = $row['email'];

//capturamos el nombre de la empresa
$stmtpi = $con->prepare("SELECT * FROM tb_empresas WHERE id = ? LIMIT 1");
$stmtpi->bind_param("i", $restringido_a);
$stmtpi->execute();
$result = $stmtpi->get_result();
$row = $result->fetch_assoc();
$nombre_empresa = $row['nombre'];

//capturamos las empresas y distancias a la ubicacion del aviso
$response_empresas = array();
$nombre_e = "";
$consulta = mysqli_query($con,
"
SELECT id,latitud,longitud,nombre 

FROM tb_empresas
"

);

while($resultado_consulta = mysqli_fetch_array($consulta)){

    array_push($response_empresas,$resultado_consulta);

}
$list = "";
$latitud1 = $latitud;
$longitud1 = $longitud;




foreach ($response_empresas as $row) {

    $latitud2 = $row['latitud'];
    $longitud2 = $row['longitud'];

   $distancia = getDistanceBetweenPointsNew($latitud1,$longitud1,$latitud2,$longitud2);

   $distancia = $distancia * 1000;


   if($distancia <= $diametro){
    $list = $list.$row['nombre']." => ".$distancia." m"."<br>";
   }



    
    
    
}



//iteramos la tabla de usuarios internos para capturar 
//EDITORES
//SEGURIDAD


    

$qry = mysqli_query($con,

"
SELECT usuarios.email as email


FROM tb_usuarios_internos internos

LEFT JOIN tb_usuarios usuarios ON internos.id_usuario = usuarios.id
LEFT JOIN tb_tipos_internos tipo ON internos.id_tipo_interno = tipo.id
LEFT JOIN tb_grupos_internos grupo ON internos.id_grupo_interno = grupo.id

WHERE tipo.id =2 AND grupo.id = 1


"


);

while($result = mysqli_fetch_array($qry)){
    $receptor = $result["email"];
$h1 = "Aviso recibido en ZFseguretat";
$mensaje = "
<p>Se acaba de registrar un aviso en la plataforma</p>
<br><br><br>

<strong>Autor del aviso</strong><br>
<h3>".$email."</h3>
<strong>Título del aviso</strong><br>
<h3>".$titulo."</h3>
<strong>Descripción del aviso</strong><br>
<h3>".$descripcion."</h3>
<strong>Calle del aviso</strong><br>
<h3>".$calle."</h3>
<strong>Tipo de aviso</strong><br>
<h3>".$tipo_de_aviso."</h3>
<strong>Visibilidad del aviso</strong><br>
<h3>".$visibilidad."</h3>
<strong>Fecha de inicio</strong><br>
<h3>".$newDateI."</h3>
<strong>Antelación de la publicación</strong><br>
<h3>".$activar_x_antes."</h3>
<strong>Fecha de finalización</strong><br>
<h3>".$newDateF."</h3>

";

if($visibilidad == "Empresa"){
    $mensaje .= "
    <strong>Empresa afectada</strong><br>
    <h3>".$nombre_empresa."</h3>

    ";
}
if($visibilidad == "Diametro"){
    $mensaje .= "
    <strong>Distancia al aviso</strong><br>
    <h3>".$diametro.' m'."</h3>
    <strong>Empresas afectadas</strong><br>
    <h3>".$list."</h3>

    ";
}




    envia_email($receptor,$h1,$mensaje);
    

}

mysqli_close($con);





?>