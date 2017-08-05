<?php
	session_start();
	require("../lib/conexion.php");
	$codUserE= $_SESSION['cod_usuarioE'];
	$codM = $_REQUEST['username'];
	$sql2="update mensaje set visto=1 where fk_UsuarioEm=?  and CodMensaje=?";
	$insert= $conexion->prepare($sql2);
	$insert->execute(array($codUserE,$codM));
?>