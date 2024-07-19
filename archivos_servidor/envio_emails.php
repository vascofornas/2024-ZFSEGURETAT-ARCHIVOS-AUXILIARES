<?php

//REQUIRE PARA FUNCIONES DE PHPMAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


require 'connect.php';

function envia_email($receptor,$h1,$mensaje){


    //ENVIO EMAIL AL usuario
    $email = $receptor;
          
    
    $to = $email;
    $subject = "Bienvenid@ a ZFseguretat";
    
    $htmlContent = '
    <html>
    <head>
    <title>Prueba email </title>
    </head>
    <body style="background-color: #ffffff; color:#8EC3DF ;text-align: center">
    <img src="https://faro.red/zfseguretat/zf.png" alt="ZF" height="200" >
    
    <h1>'.$h1.' </h1>
    
    
    <h4 style="background-color: #ffffff; color:#000000 ;text-align: left">'.$mensaje.'</h4>
    
    
    
    
    <h3 style="background-color: #ffffff; color:#8EC3DF ;text-align: left">Saludos cordiales</h3>
    <h3 style="background-color: #ffffff; color:#8EC3DF ;text-align: left">El equipo de ZFseguretat</h3>
    
    
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
    

$qry = mysqli_query($con,

"
SELECT * FROM tb_usuarios
WHERE email = 'modes@faro.red' 


"


);

while($result = mysqli_fetch_array($qry)){
    $receptor = $result["email"];
$h1 = "H1 del mensaje";
$mensaje = "texto del mensaje";

    envia_email($receptor,$h1,$mensaje);
    echo $result["id"];

}

mysqli_close($con);



?>