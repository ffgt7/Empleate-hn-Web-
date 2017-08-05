<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	require "../lib/conexion.php";
	if(!isset($_POST['idioma']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$idioma=$_POST['idioma'];
	$nivel=$_POST['nivel'];
	$cod=$_POST["cod"];

	$sql=("update curri_idioma set idioma=?, nivel=?  where cod_idioma=:miCod");
	
	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($idioma,$nivel,$cod)); 
	
	header("Location:../ModulC/perfil_usuario.php");  
	
	
	
?>