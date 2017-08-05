<?php
	include("../lib/conexion.php");

	$sql="select cod_propuesta,cargoP,nombreP,descripcionP from propuesta";
	$resultado= $conexion->prepare($sql);
	$resultado->execute();
	$n=$resultado->fetchAll();
	$json = array("items" => $n);
	echo json_encode($json);