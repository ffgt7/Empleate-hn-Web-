<html>
<?php require "../lib/movil.php"; ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	require "../lib/conexion.php";
	include("../lib/config.php");
	if(!isset($_POST["cod"]))
	{
		require("../lib/permisosG.php");
		return;
	}
	$cod=$_POST["cod"];
	$blog=$_POST["editor"];
	$categoria=$_POST["cate"];
	
	$sql="update blog set categoria=?, blog=? where codBlog=?";
	
	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($categoria, $blog, $cod));
	
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
?>