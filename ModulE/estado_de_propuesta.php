<html>
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
  $estado = $_GET["es"];

  if($estado == 1){

  	$conexion->query("update  propuesta set estado = 1 where cod_propuesta='$cod'");

  	header("Location:../ModulC/perfil_empresa.php");

  }elseif ($estado == 0) {

    $conexion->query("update  propuesta set estado = 0 where cod_propuesta='$cod'");

  	header("Location:../ModulC/perfil_empresa.php");
  }

?>
