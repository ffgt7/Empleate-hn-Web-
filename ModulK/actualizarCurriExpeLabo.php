<html>
<?php require("../lib/movil.php"); ?>
	<script src="../js/sweetalert-dev.js"></script>
	<link href="../css/sweetalert.css" rel="stylesheet" type="text/css"/>
	<script src="../js/sweetalert.min.js"></script>
</html>
<?php
	require "../lib/conexion.php";
	if(!isset($_POST['Nomb_Empre']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$nombEmpre=$_POST['Nomb_Empre'];
	$pais=$_POST['pais'];
	$actiEmpre=$_POST['Acti_Empre'];
	$puestCargo=$_POST['PuestCargo'];
	$cate=$_POST['Categoria'];
	$puest=$_REQUEST['PustoDesem'];
	//$puest = isset($_POST['PustoDesem']) ? $_POST['PustoDesem'] : NULL;
	$descripFuncio=$_POST['Descrip_Funcio'];
	$fechIni=$_POST['Fech_Ini'];
	$fechFin=$_POST['Fech_Fin'];
	$cod=$_POST["cod"];

	
	$sql=("update curri_ExpeLabo set Nomb_Empre=?, fk_pais=?, fk_actividad=?,nomb_EscriPuesto=?, 
			fk_categ=?,fk_puesto=?,descrip_Funcio=?,fech_IniTra=?,fech_FinTra=? where cod_curri=?");
	
	$resultado=$conexion->prepare($sql);
	
	$resultado->execute(array($nombEmpre,$pais,$actiEmpre,$puestCargo,$cate,$puest,$descripFuncio,$fechIni,$fechFin,$cod));

	header("Location:../ModulC/perfil_usuario.php"); 
?>