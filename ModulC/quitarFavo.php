<html>
<script src="../js/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../js/dist/sweetalert.css">
</html>
<?php 
	require("../lib/movil.php"); 
    include("../lib/config.php");
	if(!isset($_GET['codU']))
	{
		require("../lib/permisosG.php");
		return;
	  }
		require("nav.php");
		require("../lib/permisosU.php");
		include("../lib/conexion.php");

		$codU=$_GET['codU'];
		$codUser=$_SESSION["cod_usuario"];
		
		$sqlU="delete from favoritos where fk_empre=? and fk_usuario=?";
		$results=$conexion->prepare($sqlU);
		$results->execute(array($codU,$codUser));
		
		echo'<script type="text/javascript">
			swal({
			title: "Registro Eliminado",
  			text: "Se desmarco esta empresa como favorita",
  			type: "info",
			},
			function(){
				window.location.replace("';echo $rutaPrin."ModulC/empresas.php";echo'");
			});
            </script>';
			
?>