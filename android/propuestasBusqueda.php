<?php
	include("../lib/conexion.php");

	$sql="select cod_propuesta,descripcionP,imagen,cargoP from propuesta 
	join usuarios_empre on cod_usuario=fk_userEmpre where propuesta.estado = 1";
	$resultado= $conexion->prepare($sql);
	$resultado->execute();
	$n=$resultado->fetchAll();
	$json = array("items" => $n);
	echo json_encode($json);