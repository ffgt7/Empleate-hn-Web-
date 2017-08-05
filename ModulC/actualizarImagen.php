<html>
<?php require "../lib/movil.php"; ?>
	<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
	<script src= "../js/dist/sweetalert.min.js"></script>
</html>
<?php
  require("../lib/conexion.php");
  include("../lib/config.php");
  session_start();
  $cod=$_SESSION["cod_usuario"];
  
	if(!isset($_FILES['imagen_Usuario'] ['name']))
		{
			require("../lib/permisosG.php");
			return;
		}
		
	
	$nombreImg=$_FILES['imagen_Usuario'] ['name'];
	
	if($nombreImg!="")
	{
	$tipoImg=$_FILES['imagen_Usuario'] ['type'];
	$tamImg=$_FILES['imagen_Usuario'] ['size'];
	if($tamImg!=""){
		if($tamImg<=4000000 and $tamImg>=1){
			if($tipoImg=="image/jpg" || $tipoImg=="image/jpeg" || $tipoImg=="image/png" || $tipoImg=="image/gif"){
				$ruta=$_SERVER['DOCUMENT_ROOT'].'/Imagenes_Users/';
				$nombre=uniqid().$nombreImg;
				move_uploaded_file($_FILES['imagen_Usuario']['tmp_name'],$ruta.$nombre);
			}
			else{
				echo '<script>
						 swal({
							title: "Información!",
							 text: "Solo se admiten imagenes en los formatos jpg/jpeg/png/gif!",
							 type: "info",
							 confirmButtonText: "Aceptar"
						 },
						 function(){
						    window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php";echo'");
						 });
					  </script>';
					return;
				}
			}
			else{
				echo '<script>
						 swal({
							title: "Información!",
							 text: "Tamaño de la imagen demasiado grande!",
							 type: "info",
							 confirmButtonText: "Aceptar"
						 },
						 function(){
						     window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php";echo'");
						 });
					  </script>';
					return;
			}
		}

	$sql="update usuarios_empleo set img_perfil=? where cod_empleo=?";
	$resultado=$conexion->prepare($sql);
	$resultado->execute(array($nombre,$cod));
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
	  
	}
	else{
		echo '<script>
		 swal({
			title: "Información!",
			 text: "Debe seleccionar una imagen para hacer el cambio",
			 type: "info",
			 confirmButtonText: "Aceptar"
		 },
		 function(){
		    window.location.replace("';echo $rutaPrin."ModulC/perfil_usuario.php";echo'");
		 });
	  </script>';
	}
?>
