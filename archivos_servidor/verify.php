<?php
header("Access-Control-Allow-Origin: *");
require_once 'dbcon.php';

$conn = (new Database())->dbConnection();


if(isset($_GET['email']) && isset($_GET['code']))
{
 $email = $_GET['email'];
 $code = $_GET['code'];

 $statusY = "Y";
 $statusN = "N";

 $stmt = $conn->prepare("SELECT email,code,id,verificada FROM tb_usuarios WHERE email=:uID AND code=:code LIMIT 1");
 $stmt->execute(array(":uID"=>$email,":code"=>$code));
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
 if($stmt->rowCount() > 0)
 {
  if($row['verificada'] == 0)
  {
     
   $stmt = $conn->prepare("UPDATE tb_usuarios SET verificada=1 WHERE email=:uID");

   $stmt->bindparam(":uID",$email);
   $stmt->execute();

   $msg = "
             <center><h1 style='color: #5e9ca0;'>Gràcies per confiar en l'app de ZF Barcelona</h1>
<center><h1 style='color: #5e9ca0;'>Gracias por confiar en la app de ZF Barcelona</h1>
<center><h1 style='color: #5e9ca0;'>Thank you for trusting the ZF Barcelona app</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<center><h2 style='color: #2e6c80;'>El teu compte ha estat activat</center></h2>
<center><h2 style='color: #2e6c80;'>Tu cuenta ha sido activada</center></h2>
<center><h2 style='color: #2e6c80;'>Your account has been activated</center></h2>
          ";
        
  }
  else
  {
   $msg = "
             <center><h1 style='color: #5e9ca0;'>Gràcies per confiar en l'app de ZF Barcelona</h1>
<center><h1 style='color: #5e9ca0;'>Gracias por confiar en la app de ZF Barcelona</h1>
<center><h1 style='color: #5e9ca0;'>Thank you for trusting the ZF Barcelona app</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<center><h2 style='color: #2e6c80;'>El teu compte ja estava activat</center></h2>
<center><h2 style='color: #2e6c80;'>Tu cuenta ya estaba activada</center></h2>
<center><h2 style='color: #2e6c80;'>Your account was already activated</h2>
          
          ";
  }
 }
 else
 {
  $msg = "
         <center><h1 style='color: #5e9ca0;'>Gràcies per confiar en l'app de ZF Barcelona</h1>
<center><h1 style='color: #5e9ca0;'>Gracias por confiar en la app de ZF Barcelona</h1>
<center><h1 style='color: #5e9ca0;'>Thank you for trusting the ZF Barcelona app</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<center><h2 style='color: #2e6c80;'>El vostre compte d'usuari no existeix</center></h2>
<center><h2 style='color: #2e6c80;'>Tu cuenta de usuario no existe</center></h2>
<center><h2 style='color: #2e6c80;'>Your user account does not exist</h2>
      ";
 }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Confirmación de registro</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
  <?php if(isset($msg)) { echo $msg; } ?>
    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
