<html>
<?php require "../lib/movil.php"; ?>
	<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
	<script src= "../js/dist/sweetalert.min.js"></script>
</html>
<?php
  require("../lib/conexion.php");
  require("../lib/Llenado_Select.php");
  include("../lib/config.php");
  session_start();
  $cod=$_SESSION["codAdmin"];
  $sql="select contraseñaAdmin from admin where codAdmin=$cod";
  $resul=new Llenado_Select();
  $array=$resul->llenarSelect($sql);
  foreach($array as $elementos):
  endforeach;
  $passActual=$_POST["pass"];
  $pass_empleo=$_POST['nuevaPass'];
	$contraEncrip=password_hash($pass_empleo, PASSWORD_DEFAULT);
	$confirmarPass=$_POST['confirmarPass'];
  if(password_verify($passActual,$elementos["contraseñaAdmin"])){
    if(password_verify($confirmarPass,$contraEncrip)){
      $sql="update admin set contraseñaAdmin=? where codAdmin=?";
      $resultado=$conexion->prepare($sql);
      $resultado->execute(array($contraEncrip,$cod));
      echo '<script>
           swal({
              title: "Información!",
               text: "El cambio se realizo exitosamente!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
            window.location.replace("';echo $rutaPrin."ModulC/perfilAdministrador.php";echo'");
           });
           
        </script>';
    }else{
      echo '<script>
            swal({
               title: "Información!",
                text: "Las contraseñas no coinciden!",
                type: "info",
                confirmButtonText: "Aceptar"
            },
            function(){
                window.location.replace("';echo $rutaPrin."ModulC/perfilAdministrador.php";echo'");
            });
         </script>';
    }
  }else{
    echo '<script>
          swal({
             title: "Información!",
              text: "Las contraseña actual nos es la misma que la de la BD!",
              type: "info",
              confirmButtonText: "Aceptar"
          },
          function(){
            window.location.replace("';echo $rutaPrin."ModulC/perfilAdministrador.php";echo'");
          });
       </script>';
  }
?>
