<html>
<script src="../js/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../js/dist/sweetalert.css">
</html>
<?php 
	require("../lib/movil.php"); 
    include("../lib/config.php");
	if(!isset($_GET['cod']))
	{
		require("../lib/permisosG.php");
		return;
	  }
		require("nav.php");
		require("../lib/permisosU.php");
		include("../lib/conexion.php");

		$cod=$_GET['cod'];
		$codU=$_GET['codU'];
		$codUser=$_SESSION["cod_usuario"];
		$sqlU="insert into favoritos(fk_empre,fk_usuario) values (?,?)";
		$results=$conexion->prepare($sqlU);
		$results->execute(array($codU,$cod));
		
		echo'<script type="text/javascript">
			swal({
			title: "Registro Agregado",
  			text: "Se agrego esta empresa a favoritos",
  			type: "info",
			},
			function(){
				window.location.replace("';echo $rutaPrin."ModulC/empresas.php";echo'");
			});
            </script>';
			
?>