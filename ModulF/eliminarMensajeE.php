<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>	
<?php
	
	require "../lib/conexion.php";
	if(!isset($_GET["cod"]))
			{
				require("../lib/permisosG.php");
				return;
			}
	
	$cod=$_GET["cod"];
	
	
	$conexion->query("delete from mensaje where CodMensaje='$cod'");
	
	 echo '<script>
           swal({
              title: "Información!",
               text: "La eliminacion se realizo exitosamente!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
           window.location.href="mensajes2.php"
           });
        </script>';