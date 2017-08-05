<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	require "../lib/conexion.php";
	if(!isset($_POST["nombreR"]))
	{
		require("../lib/permisosG.php");
		return;
	}
	$nombre=$_POST["nombreR"];
	$apellido=$_POST["apellidoR"];
	$identidad=$_POST["identidadR"];
	$direccion=$_POST["direccionR"];
	$telF=$_POST["telFR"];
	$telM=$_POST["telMR"];
	$correo=$_POST["correoR"];
	$correo2=$_POST["correo2"];
	$cod=$_POST["cod"];
				
			
	$sql=("update referencia set nombreR=?, apellidoR=?, identidadR=?,direccionR=?, 
	telFR=?,telMR=? where cod_referencai=?");
	
	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($nombre,$apellido,$identidad,$direccion,
	$telF, $telM, $cod)); 
	
	header("Location:../ModulC/perfil_usuario.php"); 
 

			
		
?>

