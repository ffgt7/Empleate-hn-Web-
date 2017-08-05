<html>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	$nomb_user=htmlentities(addslashes($_POST['Nomb_Usuario']));
	$pass_empleo=$_POST['Contrase'];
	$contraEncrip=password_hash($pass_empleo, PASSWORD_DEFAULT);
	include("../lib/conexion.php");
	$insert="insert into admin(userAdmin,contraseñaAdmin) values(?,?)";
	$result=$conexion->prepare($insert);
	$result->execute(array($nomb_user,$contraEncrip));
?>