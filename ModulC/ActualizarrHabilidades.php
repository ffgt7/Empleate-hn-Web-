<html>
<?php require "../lib/movil.php"; ?>
	<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
	<script src= "../js/dist/sweetalert.min.js"></script>
</html>
<?php
  require("../lib/conexion.php");
  include("../lib/config.php");
  session_start();
  $cod=$_POST["cod"];
  $nivel=$_POST["nivel"];
  $sql="update curriHabilidades set fk_nivelHabi=? where cod_curriHabi=?";
  $resultado=$conexion->prepare($sql);
  $resultado->execute(array($nivel,$cod));
  echo '<script>
           swal({
              title: "Información!",
               text: "El cambio se realizo exitosamente!", 
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
            window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php#team";echo'");
            
           });
        </script>';
 ?>