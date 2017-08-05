<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>	
<?php
	include("../lib/config.php");
	require "../lib/conexion.php";
	if(!isset($_GET["cod"]))
			{
				require("../lib/permisosG.php");
				return;
			}
	
	$cod=$_GET["cod"];
	
	
	$conexion->query("delete from propuesta where cod_propuesta='$cod'");
	
	echo '<script>
           swal({
              title: "Información!",
               text: "La propuesta se elimino exitosamente!",
               type: "info",
               confirmButtonText: "Aceptar"
           },
           function(){
            window.location.replace("';echo $rutaPrin."ModulC/perfil_empresa.php";echo'");
            
           });
        </script>';
	
?>
