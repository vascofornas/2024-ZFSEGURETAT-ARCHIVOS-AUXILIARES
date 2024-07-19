<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//REQUIRE PARA FUNCIONES DE PHPMAILER

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//header("Access-Control-Allow-Origin: *");
include("connect.php");

if ($con->connect_error){
	die("Connection failed: " . $conn->connect_error);
	return;
}
//enviar los datos a la app
function respuestaApp($email,$conn){
    $stmt = $conn->prepare("SELECT  email, encrypted_password, salt,creada_el,actualizada_el,imagen,nombre,apellidos,id,verificada,activo,tipo_usuario,token_firebase FROM tb_usuarios WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt-> bind_result($token3,$token4,$token5,$token6,$token7,$token8,$token9,$token10,$token12,$token13,$token14,$token15,$token16);
      while ( $stmt-> fetch() ) {
       
       $user["email"] = $token3;
       $user["encrypted_password"] = $token4;
       $user["salt"] = $token5;
       $user["creada_el"] = $token6;
       $user["actualizada_el"] = $token7;
       $user["imagen"] = $token8;
       $user["nombre"] = $token9;
       $user["apellidos"] = $token10;
       $user["id"] = $token12;
       $user["verificada"] = $token13;
       $user["activo"] = $token14;
       $user["tipo_usuario"] = $token15;
       $user["token_firebase"] = $token16;

     }
     $stmt->close();
     return $user;



}

function enviarEmail($email,$code){
     //ENVIO EMAIL AL usuario
      

     $to = $email;
     $subject = "Bienvenid@ a ZFseguretat";

     $htmlContent = '
     <html>
     <head>
     <title>Confirmación de registro </title>
     </head>
     <body style="background-color: #ffffff; color:#8EC3DF ;text-align: center">
     <img src="https://zfseguretat.es/appseguridad/zf.png" alt="ZF" height="200" >
     <h1>Gracias por unirte a la Comunidad de ZFseguretat  !</h1>


     Para completar el proceso de registro con la cuenta '.$email.', por favor, haga click sobre el siguiente enlace<br/>
     <br /><br />
     <a href="https://zfseguretat.es/appseguridad/flutter_api/verify.php?email='.$email.'&code='.$code.'">Click AQUI para activar tu cuenta :)</a>
     <br /><br />




     <h3>Saludos cordiales</h3>
     <h3>El equipo de ZFseguretat</h3>


     </body>
     </html>';

// Set content-type header for sending HTML email
     $headers = "MIME-Version: 1.0" . "\r\n";
     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
     $email_superadmin = "info@zfseguretat.es";
     $headers .= 'From: ZF  App<info@zfseguretat.es>' . "\r\n";
     $headers .= 'Cc: '.$email_superadmin. "\r\n";
     /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
     $mail = new PHPMailer(TRUE);
     $mail->IsHTML(true);


     $mail->isSMTP();
     $mail->SMTPAuth = true;
     $mail->SMTPSecure = 'tls';
     $mail->Host = "zfseguretat.es";
     $mail->Port = 587;
     $mail->Username = "info@zfseguretat.es";
     $mail->Password = "7E4!1brl0";

     $mail->CharSet = 'UTF-8';
     $mail->Encoding = 'base64';

     /* Open the try/catch block. */
     try {
      /* Set the mail sender. */
      $mail->setFrom('info@zfseguretat.es', 'Administrador de ZFseguretat');

      /* Add a recipient. */
     
      $mail->addAddress($email_superadmin, "Administrador de ZFseguretat");
      $mail->addAddress($email, $email);
      $mail->addBCC('campas@zfbarcelona.es', 'Xavi Campas');

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
    
    }
    catch (\Exception $e)
    {
      /* PHP exception (note the backslash to select the global namespace Exception class). */
      
    }

// Send email
    if(1 ==1):
     $successMsg = 'Email enviado.';
   else:
     $errorMsg = 'Email sending fail.';
   endif;

}




function registrarUsuarioExterno($email,$encrypted_password,$salt,$code,$date,$tipo,$conn){
  //CREAMOS UN USUARIO   
    $get_result = $conn->query("INSERT INTO tb_usuarios  (
        email,
        encrypted_password,
        salt,
        code,
        creada_el,
        actualizada_el,
        tipo_usuario) VALUES (
            '".$email."',
            '".$encrypted_password."',
            '".$salt."',
            '".$code."',
            '".$date."',
            '".$date."',
            '".$tipo."')"); 
 
    if($get_result === true){
    $id_usuario = $conn->insert_id;
    
    //CREAMOS UN USUARIO EXTERNO
    $tipo_externo = 3;

    $get_result = $conn->query("INSERT INTO tb_usuarios_externos  (
        id_usuario,
        id_tipo_ext,
        fecha_alta,
        fecha_actualizacion) 
        VALUES 
        (
            '".$id_usuario."',
            '".$tipo_externo."',
            '".$date."',
            '".$date."')"); 
 
    if($get_result === true){
    $id_usuario = $conn->insert_id;
    

    //enviar email
    enviarEmail($email,$code);

    //enviar datos del usuario a la app
    $user = respuestaApp($email,$conn);
    // json response array
    $response = array("error" => FALSE);
    $response["user"]["id"] = $user["id"];
    $response["user"]["email"] = $user["email"];
    $response["user"]["imagen"] = $user["imagen"];
    $response["user"]["nombre"] = $user["nombre"];
    $response["user"]["apellidos"] = $user["apellidos"];
    $response["user"]["verificada"] = $user["verificada"];
    $response["user"]["activo"] = $user["activo"];
    $response["user"]["token_firebase"] = $user["token_firebase"];
    $response["user"]["tipo_usuario"] = $user["tipo_usuario"];
  

    echo json_encode( $response, JSON_UNESCAPED_UNICODE );
   
    
    
    
    }else{
    
    }

    //FIN CREAR USUARIO EXTERNO



    
    
    }else{
    
    }

}

function registrarUsuarioInterno($email,$encrypted_password,$salt,$code,$date,$tipo,$conn){
    //CREAMOS UN USUARIO   
      $get_result = $conn->query("INSERT INTO tb_usuarios  (
          email,
          encrypted_password,
          salt,
          code,
          creada_el,
          actualizada_el,
          tipo_usuario) VALUES (
              '".$email."',
              '".$encrypted_password."',
              '".$salt."',
              '".$code."',
              '".$date."',
              '".$date."',
              '".$tipo."')"); 
   
      if($get_result === true){
      $id_usuario = $conn->insert_id;
     
      //CREAMOS UN USUARIO INTERNO
      $tipo_interno = 5;
      $grupo_interno = 6;
  
      $get_result = $conn->query("INSERT INTO tb_usuarios_internos  (
          id_usuario,
          id_tipo_interno,
          id_grupo_interno,
          fecha_alta,
          fecha_baja,
          fecha_actualizacion) 
          VALUES 
          (
              '".$id_usuario."',
              '".$tipo_interno."',
              '".$grupo_interno."',
              '".$date."',
              '".$date."',
              '".$date."')"); 
   
      if($get_result === true){
      $id_usuario = $conn->insert_id;
      
  
      //enviar email
      enviarEmail($email,$code);
  
      //enviar datos del usuario a la app
        //enviar datos del usuario a la app
    $user = respuestaApp($email,$conn);
    // json response array
    $response = array("error" => FALSE);
    $response["user"]["id"] = $user["id"];
    $response["user"]["email"] = $user["email"];
    $response["user"]["imagen"] = $user["imagen"];
    $response["user"]["nombre"] = $user["nombre"];
    $response["user"]["apellidos"] = $user["apellidos"];
    $response["user"]["verificada"] = $user["verificada"];
    $response["user"]["activo"] = $user["activo"];
    $response["user"]["token_firebase"] = $user["token_firebase"];
    $response["user"]["tipo_usuario"] = $user["tipo_usuario"];
  

    echo json_encode( $response, JSON_UNESCAPED_UNICODE );
      
      
      }else{
      
      }
  
      //FIN CREAR USUARIO INTERNO
  
  
  
      
      
      }else{
      
      }
  
  }
function getUsuarioPorEmail($email,$password,$conn){

    $uuid = uniqid('', true);
    $tipo_ext= 2;
    $tipo_int= 1;
    $tipo_externo = 3;
    $salt = 12;
 
    $code = md5(uniqid(rand()));
    date_default_timezone_set ('Europe/Madrid');
    $date = date('Y-m-d H:i:s');
    $encrypted_password =password_hash($password,PASSWORD_DEFAULT);
 
 
    $sql=mysqli_query($conn,"SELECT * FROM tb_usuarios where email='$email'");
    if(mysqli_num_rows($sql)>0)
{
    echo "Email Id Already Exists"; 
	exit;
}
else {
    $dominio = substr(strrchr($email, "@"), 1);

   if($dominio == "zfbarcelona.es" || $dominio == "faro.red"  ){
       
       registrarUsuarioInterno($email,$encrypted_password,$salt,$code,$date,$tipo_int,$conn);
   }
   else {
   
    registrarUsuarioExterno($email,$encrypted_password,$salt,$code,$date,$tipo_ext,$conn);

   }
   
    
   

}
 }




    // receiving the post params
    
    $email = $_POST['email'];
   
    $password = $_POST['password'];
  // $email = "s233dfd@qwe.qwe";
  // $password = "12345678";
   
    $test1 = getUsuarioPorEmail($email,$password,$con);
   
    
    





?>
