<html>
<?php 
    require "../lib/movil.php";
    include("../lib/config.php");
?>
	<link rel= "stylesheet" type="text/css" href="../js/dist/sweetalert.css">
	<script src= "../js/dist/sweetalert.min.js"></script>
</html>
<?php
echo '<script>
		 swal({
				title: "Información!",
				 text: "El cambio se realizo exitosamente!",
				 type: "info",
				 confirmButtonText: "Aceptar"
		 },
		 function(){
		    window.location.replace("';echo $rutaPrin."ModulC/perfil_empresa.php";echo'");
		    
		 });
	</script>';
?>
