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
	$cate=$_POST["cate"];
	$titulo=$_POST["titulo"];
	$link=$_POST["link"];
	$descripcion=$_POST["descripcion"];
	
	$sql="update videos set FKcategoria=?, link=?, descripcion=?, titulo=? where codVideo=?";
	
	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($cate,$link,$descripcion,$titulo,$cod));
	
	echo '<script>
		 swal({
			title: "Información",
			 text: "El cambio se realizo exitosamente!",
			 type: "info",
			 confirmButtonText: "Aceptar"
		 },
		 function(){
		    window.location.replace("';echo $rutaPrin."ModulC/perfilAdministrador.php";echo'");
		 });
	  </script>';
?>