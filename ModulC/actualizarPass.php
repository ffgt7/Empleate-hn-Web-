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
  $cod=$_SESSION["cod_usuario"];
  $sql="select pass_empleo from usuarios_empleo where cod_empleo=$cod";
  $resul=new Llenado_Select();
  $array=$resul->llenarSelect($sql);
  foreach($array as $elementos):
  endforeach;
  $passActual=$_POST["pass"];
  $pass_empleo=$_POST['nuevaPass'];
	$contraEncrip=password_hash($pass_empleo, PASSWORD_DEFAULT);
	$confirmarPass=$_POST['confirmarPass'];
  if(password_verify($passActual,$elementos["pass_empleo"])){
    if(password_verify($confirmarPass,$contraEncrip)){
      $sql="update usuarios_empleo set pass_empleo=? where cod_empleo=?";
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
            window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php";echo'");
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
                window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php";echo'");
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
            window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php";echo'");
          });
       </script>';
  }
?>
