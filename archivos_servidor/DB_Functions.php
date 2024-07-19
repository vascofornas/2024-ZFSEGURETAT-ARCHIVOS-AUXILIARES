<?php


 /* Namespace alias. */
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;


class DB_Functions {

 

  private $conn;

    // constructor
  function __construct() {
    require_once 'DB_Connect.php';
  
        // connecting to database
    $db = new Db_Connect();
    $this->conn = $db->connect();
  }

    // destructor
  function __destruct() {

  }

  public function storeEmpresa($nombre, $latitud, $longitud, $dominio, $dominio2, $dominio3, $dominio4,
  $logo, $direccion) {

    //REQUIRE PARA FUNCIONES DE PHPMAILER
    
       
          $code = md5(uniqid(rand()));
          date_default_timezone_set('Europe/Madrid');
          $date = date('Y-m-d H:i:s');
    
       
    
    //REGISTRO DE EMPRESA EN tb_empresas
    
            $stmt = $this->conn->prepare("INSERT INTO tb_empresas(
             
              nombre, 
              latitud, 
              longitud, 
              dominio,
              dominio2,
              dominio3,
              dominio4,
              logo,
              direccion
              ) 
    
              VALUES(
               
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?
               )
              "
            );
    
            $stmt->bind_param("sssssssss", 
      
              $nombre, 
              $latitud, 
              $longitud, 
              $dominio,
              $dominio2,
              $dominio3,
              $dominio4,
            $logo,
        $direccion);
    
              $result = $stmt->execute();
    
              $stmt->close();



              if ($result) {
                $stmt = $this->conn->prepare("SELECT  nombre, logo FROM tb_empresas WHERE nombre = ?");
                $stmt->bind_param("s", $nombre);
                $stmt->execute();
                $stmt-> bind_result($token3,$token4);
                while ( $stmt-> fetch() ) {
                 
                 $empresa["nombre"] = $token3;
                 $empresa["logo"] = $token4;
                                }
               $stmt->close();
          
               return $empresa;
             } else {
              return false;
    
    
             }
      
    }
    public function envioEmailCodigoPass($email, $codigo) {

        //REQUIRE PARA FUNCIONES DE PHPMAILER
        
              require 'PHPMailer/src/Exception.php';
              require 'PHPMailer/src/PHPMailer.php';
              require 'PHPMailer/src/SMTP.php';
        
         //password  google mail ccfxosiqsakcumit
        
        
         //ENVIO EMAIL AL usuario
              
              header('Content-Type: text/html; charset=utf-8' );
              $to = $email;
              $subject = "Bienvenid@ a ZFseguretat";
        
              $htmlContent = '
              <html>
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
              <meta charset="utf8mb4">
              <title>Código para cambio de contraseña </title>
              </head>
              <body style="background-color: #ffffff; color:#8EC3DF ;text-align: center">
              <img src="https://faro.red/zfseguretat/zf.png" alt="ZF" height="200" >
              <h1>Gracias por unirte a la Comunidad de ZFseguretat!</h1>
        
        
              Este es el código que tienes que insertar en la app para poder cambiar tu contraseña de acceso<br/>
              <br /><br />
              <h2>'.
                $codigo.
              '</H2>
              <br /><br />
        
        
        
        
              <h3>Saludos cordiales</h3>
              <h3>El equipo de de ZFseguretat</h3>
        
        
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
               $mail->setFrom('evan.zero.faro.red@gmail.com', 'Administrador de de ZFseguretat');
        
               /* Add a recipient. */
              
               $mail->addAddress($email_superadmin, "Administrador de de ZFseguretat");
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
        
                        //FIN EMAIL AL USUAROP
                
            
        }

        public function storeUserInvitado($email, $password, $empresa) {

            //REQUIRE PARA FUNCIONES DE PHPMAILER
            
                  require 'PHPMailer/src/Exception.php';
                  require 'PHPMailer/src/PHPMailer.php';
                  require 'PHPMailer/src/SMTP.php';
            
                  $uuid = uniqid('', true);
                  $tipo = 2;
                  $tipo_externo = 2;
            
                  $code = md5(uniqid(rand()));
                  date_default_timezone_set('Europe/Madrid');
                  $date = date('Y-m-d H:i:s');
            
                  $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            
                    $salt = 12;
            
            //REGISTRO DE USUARIO EN tb_usuarios
            
                    $stmt = $this->conn->prepare("INSERT INTO tb_usuarios(
                     
                      email, 
                      encrypted_password, 
                      salt, 
                      code,
                      creada_el,
                      actualizada_el,
                      tipo_usuario
                      ) 
            
                      VALUES(
                       
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?,
                       ?
                       )
                      "
                    );
            
                    $stmt->bind_param("ssssssi", 
              
                      $email, 
                      $encrypted_password, 
                      $salt, 
                      $code,
                      $date,
                      $date,
                      $tipo);
            
                      $result = $stmt->execute();
            
                      $stmt->close();
            
            //FIN REGISTRO USUARIO EN tb_usuarios
            
            
            //REGISTRO DE USUARIO EN tb_usuarios_externos
                      $id_usuario = $this->conn -> insert_id;
                      
                      $date2 = date('Y-m-d H:i:s');
                      
            
            
                    $stmt2 = $this->conn->prepare("INSERT INTO tb_usuarios_externos(
                     
                      id_usuario, 
                      id_tipo_ext, 
                      fecha_alta, 
                      fecha_actualizacion,
                      empresa
                      ) 
            
                      VALUES(
                       
                       ?,
                       ?,
                       ?,
                       ?,
                       ?
                       )
                      "
                    );
            
                    $stmt2->bind_param("iisss", 
              
                      $id_usuario, 
                      $tipo_externo, 
                      $date2, 
                      $date2,
                      $empresa
                      );
            
                      $result = $stmt2->execute();
            
                      $stmt2->close();
            
            //FIN REGISTRO USUARIO EN tb_usuarios_externos
            
            //comprobar si hay empresas que tienen como dominio el dominio del email del usuario
            
            
            //fin comprobar empresas con el dominio del usuario
            
            
            
             //ENVIO EMAIL AL usuario
                  
            
                  $to = $email;
                  $subject = "Bienvenid@ a ZFseguretat";
            
                  $htmlContent = '
                  <html>
                  <head>
                  <title>Confirmación de registro </title>
                  </head>
                  <body style="background-color: #ffffff; color:#8EC3DF ;text-align: center">
                  <img src="https://faro.red/zfseguretat/zf.png" alt="ZF" height="200" >
                  <h1>Gracias por unirte a la Comunidad de ZFseguretat  !</h1>
            
            
                  Para completar el proceso de registro, por favor, haga click sobre el siguiente enlace<br/>
                  <br /><br />
                  <a href="https://faro.red/zfseguretat/flutter_api/verify.php?email='.$email.'&code='.$code.'">Click AQUI para activar tu cuenta :)</a>
                  <br /><br />
            
            
            
            
                  <h3>Saludos cordiales</h3>
                  <h3>El equipo de ZFseguretat</h3>
            
            
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
            
                            //FIN EMAIL AL ATLETA
                    // check for successful store
                if ($result) {
                  $stmt = $this->conn->prepare("SELECT  email, encrypted_password, salt,creada_el,actualizada_el,imagen,nombre,apellidos,id,verificada,activo FROM tb_usuarios WHERE email = ?");
                  $stmt->bind_param("s", $email);
                  $stmt->execute();
                  $stmt-> bind_result($token3,$token4,$token5,$token6,$token7,$token8,$token9,$token10,$token12,$token13,$token14);
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
            
                 }
                 $stmt->close();
            
                 return $user;
               } else {
                return false;
              }
            }
            public function storeUserInvitadoInterno($email, $password) {

                //REQUIRE PARA FUNCIONES DE PHPMAILER
                
                      require 'PHPMailer/src/Exception.php';
                      require 'PHPMailer/src/PHPMailer.php';
                      require 'PHPMailer/src/SMTP.php';
                
                      $uuid = uniqid('', true);
                      $tipo = 1;
                      $tipo_interno = 5;
                      $grupo_interno = 6;
                
                      $code = md5(uniqid(rand()));
                      date_default_timezone_set('Europe/Madrid');
                      $date = date('Y-m-d H:i:s');
                
                      $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
                
                        $salt = 12;
                
                //REGISTRO DE USUARIO EN tb_usuarios
                
                        $stmt = $this->conn->prepare("INSERT INTO tb_usuarios(
                         
                          email, 
                          encrypted_password, 
                          salt, 
                          code,
                          creada_el,
                          actualizada_el,
                          tipo_usuario
                          ) 
                
                          VALUES(
                           
                           ?,
                           ?,
                           ?,
                           ?,
                           ?,
                           ?,
                           ?
                           )
                          "
                        );
                
                        $stmt->bind_param("ssssssi", 
                  
                          $email, 
                          $encrypted_password, 
                          $salt, 
                          $code,
                          $date,
                          $date,
                          $tipo);
                
                          $result = $stmt->execute();
                
                          $stmt->close();
                
                //FIN REGISTRO USUARIO EN tb_usuarios
                
                
                //REGISTRO DE USUARIO EN tb_usuarios_externos
                          $id_usuario = $this->conn -> insert_id;
                          
                          $date2 = date('Y-m-d H:i:s');
                          
                
                
                        $stmt2 = $this->conn->prepare("INSERT INTO tb_usuarios_internos(
                         
                          id_usuario, 
                          id_tipo_interno,
                          id_grupo_interno, 
                          fecha_alta,
                          fecha_baja, 
                          fecha_actualizacion
                          ) 
                
                          VALUES(
                           
                           ?,
                           ?,
                           ?,
                           ?,
                           ?,
                           ?
                           )
                          "
                        );
                
                        $stmt2->bind_param("iiisss", 
                  
                          $id_usuario, 
                          $tipo_interno, 
                          $grupo_interno,
                          $date2, 
                          $date2,
                          $date2
                          );
                
                          $result = $stmt2->execute();
                
                          $stmt2->close();
                
                //FIN REGISTRO USUARIO EN tb_usuarios_externos
                
                //comprobar si hay empresas que tienen como dominio el dominio del email del usuario
                
                
                //fin comprobar empresas con el dominio del usuario
                
                
                
                 //ENVIO EMAIL AL usuario
                      
                
                      $to = $email;
                      $subject = "Bienvenid@ a ZFseguretat";
                
                      $htmlContent = '
                      <html>
                      <head>
                      <title>Confirmación de registro </title>
                      </head>
                      <body style="background-color: #ffffff; color:#8EC3DF ;text-align: center">
                      <img src="https://faro.red/zfseguretat/zf.png" alt="ZF" height="200" >
                      <h1>Gracias por unirte a la Comunidad de ZFseguretat  !</h1>
                
                
                      Para completar el proceso de registro, por favor, haga click sobre el siguiente enlace<br/>
                      <br /><br />
                      <a href="https://faro.red/zfseguretat/flutter_api/verify.php?email='.$email.'&code='.$code.'">Click AQUI para activar tu cuenta :)</a>
                      <br /><br />
                
                
                
                
                      <h3>Saludos cordiales</h3>
                      <h3>El equipo de ZFseguretat</h3>
                
                
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
                
                                //FIN EMAIL AL ATLETA
                        // check for successful store
                    if ($result) {
                      $stmt = $this->conn->prepare("SELECT  email, encrypted_password, salt,creada_el,actualizada_el,imagen,nombre,apellidos,id,verificada,activo FROM tb_usuarios WHERE email = ?");
                      $stmt->bind_param("s", $email);
                      $stmt->execute();
                      $stmt-> bind_result($token3,$token4,$token5,$token6,$token7,$token8,$token9,$token10,$token12,$token13,$token14);
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
                
                     }
                     $stmt->close();
                
                     return $user;
                   } else {
                    return false;
                  }
                }

    public function storeUser($email, $password) {

//REQUIRE PARA FUNCIONES DE PHPMAILER

      require 'PHPMailer/src/Exception.php';
      require 'PHPMailer/src/PHPMailer.php';
      require 'PHPMailer/src/SMTP.php';

      $uuid = uniqid('', true);
      $tipo = 2;
      $tipo_externo = 3;

      $code = md5(uniqid(rand()));
      date_default_timezone_set('Europe/Madrid');
      $date = date('Y-m-d H:i:s');

      $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $salt = 12;




//$domain = array_pop(explode('@', $email));
//

$domain = array_pop(explode('@', $email));



if($domain == "zfbarcelona.es"){
   //REGISTRO DE USUARIO EN tb_usuarios_internos

//REGISTRO DE USUARIO EN tb_usuarios
$tipo = 1;

$stmt = $this->conn->prepare("INSERT INTO tb_usuarios(
         
    email, 
    encrypted_password, 
    salt, 
    code,
    creada_el,
    actualizada_el,
    tipo_usuario
    ) 

    VALUES(
     
     ?,
     ?,
     ?,
     ?,
     ?,
     ?,
     ?
     )
    "
  );

  $stmt->bind_param("ssssssi", 

    $email, 
    $encrypted_password, 
    $salt, 
    $code,
    $date,
    $date,
    $tipo);

    $result = $stmt->execute();

    $stmt->close();

//FIN REGISTRO USUARIO EN tb_usuarios
   $id_usuario = $this->conn -> insert_id;
          
   $date2 = date('Y-m-d H:i:s');
   $tipo_interno = 5;
   $grupo_interno = 6;
   


 $stmt2 = $this->conn->prepare("INSERT INTO tb_usuarios_internos(
  
   id_usuario, 
   id_tipo_interno,
   id_grupo_interno, 
   fecha_alta, 
   fecha_baja,
   fecha_actualizacion
   ) 

   VALUES(
    
    ?,
    ?,
    ?,
    ?,
    ?,
    ?
    )
   "
 );

 $stmt2->bind_param("iiisss", 

   $id_usuario, 
   $tipo_interno,
   $grupo_interno, 
   $date2, 
   $date2, 
   $date2
   );

   $result = $stmt2->execute();

   $stmt2->close();

//FIN REGISTRO USUARIO EN tb_usuarios_internos


}
else {
    //REGISTRO DE USUARIO EN tb_usuarios_externos

//REGISTRO DE USUARIO EN tb_usuarios
$tipo = 2;

$stmt = $this->conn->prepare("INSERT INTO tb_usuarios(
         
    email, 
    encrypted_password, 
    salt, 
    code,
    creada_el,
    actualizada_el,
    tipo_usuario
    ) 

    VALUES(
     
     ?,
     ?,
     ?,
     ?,
     ?,
     ?,
     ?
     )
    "
  );

  $stmt->bind_param("ssssssi", 

    $email, 
    $encrypted_password, 
    $salt, 
    $code,
    $date,
    $date,
    $tipo);

    $result = $stmt->execute();

    $stmt->close();

//FIN REGISTRO USUARIO EN tb_usuarios
    $id_usuario = $this->conn -> insert_id;
          
    $date2 = date('Y-m-d H:i:s');
    


  $stmt2 = $this->conn->prepare("INSERT INTO tb_usuarios_externos(
   
    id_usuario, 
    id_tipo_ext, 
    fecha_alta, 
    fecha_actualizacion
    ) 

    VALUES(
     
     ?,
     ?,
     ?,
     ?
     )
    "
  );

  $stmt2->bind_param("iiss", 

    $id_usuario, 
    $tipo_externo, 
    $date2, 
    $date2
    );

    $result = $stmt2->execute();

    $stmt2->close();

//FIN REGISTRO USUARIO EN tb_usuarios_externos

}






 //ENVIO EMAIL AL usuario
      

      $to = $email;
      $subject = "Bienvenid@ a ZFseguretat";

      $htmlContent = '
      <html>
      <head>
      <title>Confirmación de registro </title>
      </head>
      <body style="background-color: #ffffff; color:#8EC3DF ;text-align: center">
      <img src="https://faro.red/zfseguretat/zf.png" alt="ZF" height="200" >
      <h1>Gracias por unirte a la Comunidad de ZFseguretat  !</h1>


      Para completar el proceso de registro, por favor, haga click sobre el siguiente enlace<br/>
      <br /><br />
      <a href="https://faro.red/zfseguretat/flutter_api/verify.php?email='.$email.'&code='.$code.'">Click AQUI para activar tu cuenta :)</a>
      <br /><br />




      <h3>Saludos cordiales</h3>
      <h3>El equipo de ZFseguretat</h3>


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

                //FIN EMAIL AL ATLETA
        // check for successful store
    if ($result) {
      $stmt = $this->conn->prepare("SELECT  email, encrypted_password, salt,creada_el,actualizada_el,imagen,nombre,apellidos,id,verificada,activo FROM tb_usuarios WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt-> bind_result($token3,$token4,$token5,$token6,$token7,$token8,$token9,$token10,$token12,$token13,$token14);
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

     }
     $stmt->close();

     return $user;
   } else {
    return false;
  }
}
public function enviarEmailAdminSeguridad(){
      //REQUIRE PARA FUNCIONES DE PHPMAILER
    
      require 'PHPMailer/src/Exception.php';
      require 'PHPMailer/src/PHPMailer.php';
      require 'PHPMailer/src/SMTP.php';

       //ENVIO EMAIL AL usuario
          
    
       $to = $email;
       $subject = "Bienvenid@ a ZFseguretat";
 
       $htmlContent = '
       <html>
       <head>
       <title>Confirmación de registro </title>
       </head>
       <body style="background-color: #ffffff; color:#8EC3DF ;text-align: center">
       <img src="https://faro.red/zfseguretat/zf.png" alt="ZF" height="200" >
       <h1>Gracias por unirte a la Comunidad de ZFseguretat  !</h1>
 
 
       Para completar el proceso de registro, por favor, haga click sobre el siguiente enlace<br/>
       <br /><br />
       <a href="https://faro.red/zfseguretat/flutter_api/verify.php?email='.$email.'&code='.$code.'">Click AQUI para activar tu cuenta :)</a>
       <br /><br />
 
 
 
 
       <h3>Saludos cordiales</h3>
       <h3>El equipo de ZFseguretat</h3>
 
 
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
 
                 //FIN EMAIL AL ATLETA

}
public function storeTarea(
    $usuario_asignado,
    $descripcion,
    $latitud,
    $longitud,
    $ubicacion,
    $titulo,
    $edificio,
    $planta,
    $estancia,
    $departamento,
    $categoria,
    $subcategoria,
    $tipo,
    $fecha_hora_vencimiento,
    $fecha_hora_inicio_programada,
    $fecha_hora_inicio_efectiva,
    $fecha_hora_fin,
    $estado,
    $asignada_a_usuario,
    $asignada_a_grupo,
    $grupo  
    
   
 ) {

  

    
    //REGISTRO DE TAREA  EN tb_tareas
    
            $stmt = $this->conn->prepare("INSERT INTO tb_tareas(
             
             usuario_asignado,
    descripcion,
    latitud,
    longitud,
    ubicacion,
    titulo,
    edificio,
    planta,
    estancia,
    departamento,
    categoria,
    subcategoria,
    tipo,
    fecha_hora_vencimiento,
    fecha_hora_inicio_programada,
    fecha_hora_inicio_efectiva,
    fecha_hora_fin,
    estado,
    asignada_a_usuario,
    asignada_a_grupo,
    grupo
     
              
              ) 
    
              VALUES(
               
               
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
            
               ?
               )
              "
            );
    
            $stmt->bind_param("sssssssssssssssssssss", 
      
            $usuario_asignado,
            $descripcion,
            $latitud,
            $longitud,
            $ubicacion,
            $titulo,
            $edificio,
            $planta,
            $estancia,
            $departamento,
            $categoria,
            $subcategoria,
            $tipo,
            $fecha_hora_vencimiento,
            $fecha_hora_inicio_programada,
            $fecha_hora_inicio_efectiva,
            $fecha_hora_fin,
            $estado,
            $asignada_a_usuario,
            $asignada_a_grupo,
            $grupo

            );
    
              $result = $stmt->execute();
    
              $stmt->close();
              $id_tarea = $this->conn -> insert_id;
    
    //FIN REGISTRO AVISO
    if ($result) {
        $stmt = $this->conn->prepare("SELECT  * FROM tb_tareas WHERE id = ?");
        $stmt->bind_param("s", $id_tarea);
        $stmt->execute();
        $stmt-> bind_result(
            $token1,
            $token2,
            $token3,
            $token4,
            $token5,
            $token6,
            $token7,
            $token8,
            $token9,
            $token10,
            $token11,
            $token12,
            $token13,
            $token14,
            $token15,
            $token16,
            $token17,
            $token18,
            $token19,
            $token20,
            $token21,
            $token22,
            $token23
        );
        while ( $stmt-> fetch() ) {
         
         $tarea["id"] = $token1;
         $tarea["usuario_asignado"] = $token2;
         $tarea["descripcion"] = $token3;
         $tarea["latitud"] = $token4;
         $tarea["longitud"] = $token5;
         $tarea["ubicacion"] = $token6;
         $tarea["titulo"] = $token7;
         $tarea["edificio"] = $token8;
         $tarea["planta"] = $token9;
         $tarea["estancia"] = $token10;
         $tarea["departamento"] = $token11;
         $tarea["categoria"] = $token12;
         $tarea["subcategoria"] = $token13;
         $tarea["tipo"] = $token14;
         $tarea["fecha_hora_vencimiento"] = $token15;
         $tarea["fecha_hora_inicio_programada"] = $token16;
         $tarea["fecha_hora_inicio_efectiva"] = $token17;
         $tarea["fecha_hora_fin"] = $token18;
         $tarea["expediente"] = $token19;
         $tarea["estado"] = $token20;
         $tarea["asignada_a_usuario"] = $token21;
         $tarea["asignada_a_grupo"] = $token22;
         $tarea["grupo"] = $token23;
        
        
                        }
       $stmt->close();
  
       return $tarea;
     } else {
      return false;


     }
  
    
    
    
        
    }

public function storeAviso(
    $fecha_inicio,
    $fecha_fin,
    $latitud,
    $longitud,
    $calle,
    $descripcion,
    $tipo_aviso,
    $activar_x_antes,
    $restringido_a,
    $diametro,
    $creado_por,
    $titulo,
    $visibilidad
    
   
 ) {

  

    
    //REGISTRO DE AVISO  EN tb_avisos
    
            $stmt = $this->conn->prepare("INSERT INTO tb_avisos(
             
              fecha_inicio,
              fecha_fin,
              latitud,
              longitud,
              calle,
              descripcion,
              tipo_aviso,
              activar_x_antes,
              restringido_a,
              diametro,
              creado_por,
              titulo,
              visibilidad
              
              ) 
    
              VALUES(
               
               
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?,
               ?
               )
              "
            );
    
            $stmt->bind_param("sssssssssssss", 
      
              $fecha_inicio,
              $fecha_fin,
              $latitud,
              $longitud,
              $calle,
              $descripcion,
              $tipo_aviso,
              $activar_x_antes,
              $restringido_a,
              $diametro,
              $creado_por,
              $titulo,
              $visibilidad

            );
    
              $result = $stmt->execute();
    
              $stmt->close();
              $id_aviso = $this->conn -> insert_id;
    
    //FIN REGISTRO AVISO
    if ($result) {
        $stmt = $this->conn->prepare("SELECT  * FROM tb_avisos WHERE id = ?");
        $stmt->bind_param("s", $id_aviso);
        $stmt->execute();
        $stmt-> bind_result(
            $token1,
            $token2,
            $token3,
            $token4,
            $token5,
            $token6,
            $token7,
            $token8,
            $token9,
            $token10,
            $token11,
            $token12,
            $token13,
            $token14,
        );
        while ( $stmt-> fetch() ) {
         
         $aviso["id"] = $token1;
         $aviso["fecha_inicio"] = $token2;
         $aviso["fecha_fin"] = $token3;
         $aviso["latitud"] = $token4;
         $aviso["longitud"] = $token5;
         $aviso["calle"] = $token6;
         $aviso["descripcion"] = $token7;
         $aviso["tipo_aviso"] = $token8;
         $aviso["activar_x_antes"] = $token9;
         $aviso["restringido_a"] = $token10;
         $aviso["diametro"] = $token11;
         $aviso["creado_por"] = $token12;
         $aviso["titulo"] = $token13;
         $aviso["visibilidad"] = $token14;
        
                        }
       $stmt->close();
  
       return $aviso;
     } else {
      return false;


     }
  
    
    
    
        
    }



function getUserByEmailStateInterno($email) {

    $stmt = $this->conn->prepare("SELECT 
    usuario.id as id, 
    tipo.tipo_int as tipo, 
    grupo.grupo_int as grupo 
    FROM tb_usuarios usuario 
    LEFT JOIN tb_usuarios_internos interno ON interno.id_usuario = usuario.id 
    LEFT JOIN tb_tipos_internos tipo ON interno.id_tipo_interno = tipo.id 
    LEFT JOIN tb_grupos_internos grupo ON interno.id_grupo_interno = grupo.id 
    WHERE usuario.email = ?");
 
    $stmt->bind_param("s", $email);
 
    if ($stmt->execute()) {
      $stmt-> bind_result(
          $token1,
          $token2,
          $token7
          );
 
      while ( $stmt-> fetch() ) {
        $user["id"] = $token1;
        $user["tipo"] = $token2;
        $user["grupo"] = $token7;
        
        
 
      }
 
                    // verifying user password
 
      return $user;
 
    } else {
      return NULL;
    }
 }

 function getUserByEmailStateExterno($email) {

    $stmt = $this->conn->prepare("SELECT 
    usuario.id as id, 
    tipo.tipo_ext as tipo,
    empresa.nombre as empresa_nombre,
    empresa.dominio as empresa_dominio,
    empresa.dominio2 as empresa_dominio2,
    empresa.dominio3 as empresa_dominio3,
    empresa.dominio4 as empresa_dominio4,
    empresa.id as empresa_id,
    empresa.logo as empresa_logo,
    empresa.latitud as empresa_latitud,
    empresa.longitud as empresa_longitud,
    empresa.direccion as empresa_direccion

    FROM tb_usuarios usuario 
    LEFT JOIN tb_usuarios_externos externo ON externo.id_usuario = usuario.id 
    LEFT JOIN tb_tipos_externos tipo ON externo.id_tipo_ext = tipo.id 
    LEFT JOIN tb_empresas empresa ON externo.empresa = empresa.id 
    WHERE usuario.email = ?");
 
    $stmt->bind_param("s", $email);
 
    if ($stmt->execute()) {
      $stmt-> bind_result(
          $token1,
          $token2,
          $token3,
          $token4,
          $token5,
          $token6,
          $token7,
          $token8,
          $token9,
          $token10,
          $token11,
          $token12
          );
 
      while ( $stmt-> fetch() ) {
        $user["id"] = $token1;
        $user["tipo"] = $token2;
        $user["empresa_nombre"] = $token3;
        $user["empresa_dominio"] = $token4;
        $user["empresa_dominio2"] = $token5;
        $user["empresa_dominio3"] = $token6;
        $user["empresa_dominio4"] = $token7;
        $user["empresa_id"] = $token8;
        $user["empresa_logo"] = $token9;
        $user["empresa_latitud"] = $token10;
        $user["empresa_longitud"] = $token11;
        $user["empresa_direccion"] = $token12;
        
        
 
      }
 
                    // verifying user password
 
      return $user;
 
    } else {
      return NULL;
    }
 }

function getUserByEmailForgot($email) {

    $stmt = $this->conn->prepare("SELECT id, email FROM tb_usuarios  WHERE email = ?");
  
    $stmt->bind_param("s", $email);
 
    if ($stmt->execute()) {
      $stmt-> bind_result($token1,$token2);
 
      while ( $stmt-> fetch() ) {
        $user["id"] = $token1;
        $user["email"] = $token2;
      }
 
      return $user;
 
    } else {
      return NULL;
    }

 }
 

    public function getUserByEmailAndPassword($email, $password) {

      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

      $stmt = $this->conn->prepare("SELECT 

        usuarios.id,  
        usuarios.email, 
        usuarios.encrypted_password,
        usuarios.imagen,
        usuarios.nombre,
        usuarios.apellidos,
        usuarios.verificada,
        usuarios.activo,
        usuarios.token_firebase,
        usuarios.tipo_usuario,
        externos.id,
        tipoext.tipo_ext as tipo_externo

        FROM tb_usuarios usuarios

        LEFT JOIN tb_usuarios_externos externos ON externos.id_usuario = usuarios.id 

        LEFT JOIN tb_tipos_externos tipoext ON tipoext.id = externos.id_tipo_ext 

        



        WHERE usuarios.email = ?");

      $stmt->bind_param("s", $email);

      if ($stmt->execute()) {
        $stmt-> bind_result($token1,$token2,$token3,$token4,$token5,$token6,$token7,$token8,$token9,$token10,$token11,$token12);

        while ( $stmt-> fetch() ) {
          $user["id"] = $token1;
         
          $user["email"] = $token2;
          $user["encrypted_password"] = $token3; 
          $user["imagen"] = $token4;
          $user["nombre"] = $token5;
          $user["apellidos"] = $token6;
          $user["verificada"] = $token7;
          $user["activo"] = $token8;
          $user["token_firebase"] = $token9;
          $user["tipo_usuario"] = $token10;
          $user["tipo_externo"] = $token12;
          

        }

            // verifying user password

        $encrypted_password = $user['encrypted_password'];

            // check for password equality
        if (password_verify($password, $encrypted_password)) {
                // user authentication details are correct
          return $user;
        }
      } else {
        return NULL;
      }
    }
    
   
    public function isUserExisted($email) {
      $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

      $stmt->bind_param("s", $email);

      $stmt->execute();

      $stmt->store_result();

      if ($stmt->num_rows > 0) {
            // user existed
        $stmt->close();
        return true;
      } else {
            // user not existed
        $stmt->close();
        return false;
      }
    }





  }

  ?>
