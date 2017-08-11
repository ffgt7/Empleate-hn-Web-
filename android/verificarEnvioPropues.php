<?php
	include("../lib/conexion.php");
	
	$codP=$_POST['propuesta'];
    $codUser=$_POST["cod_usuario"];
    $sqlU="select cod_envio from enviocurri where fk_userDesem=(select cod_empleo from usuarios_empleo where nomb_user=?) and fk_propuesta=?";
	$resultado= $conexion->prepare($sqlU);
	$resultado->execute(array($codUser,$codP));
	$n=$resultado->rowCount();
	echo "$n";
	