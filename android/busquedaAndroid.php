<?php
	include("../lib/conexion.php");
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
	$resp=$_GET['cod'];
	
	$sql="select cod_propuesta as codigo, nombreP as titulo,descripcionP as descripcion,caducidadP as fecha,imagen as imagen,nomb_empre from propuesta 
	join usuarios_empre on cod_usuario=fk_userEmpre where propuesta.estado = 1 and MATCH(cargoP) AGAINST (? IN BOOLEAN MODE ) order by caducidadP asc";
	$resultado= $conexion->prepare($sql);
	$resultado->execute(array($resp));
	$n=$resultado->fetchAll();
	$json = array("items" => $n);
	echo json_encode($json);