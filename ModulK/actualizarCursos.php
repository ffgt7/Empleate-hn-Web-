<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	require "../lib/conexion.php";
	if(!isset($_POST['NombreCurso']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$nombCurso=$_POST['NombreCurso'];
	$nombEmpre=$_POST['NombreEmpresa'];
	$pais=$_POST['pais'];
	$fechIni=$_POST['Fech_Ini'];
	$fechFin=$_POST['Fech_Fin'];
	$cod=$_POST["cod"];
		
	
		
	$sql=("update curri_cursos set Nomb_curso=?, Nomb_empre=?, fk_pais=?,fech_IniTra=?, fech_FinTra=? where cod_curso=?");
	
	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($nombCurso,$nombEmpre,$pais,$fechIni,$fechFin,$cod)); 
	
	header("Location:../ModulC/perfil_usuario.php");  
	
   
?>