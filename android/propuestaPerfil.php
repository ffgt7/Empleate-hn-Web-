<?php
	require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
	$nombreUser = $_GET['cod'];
	$sql5="select cod_propuesta as codigo, nombreP as titulo,descripcionP as descripcion,caducidadP as fecha,imagen as imagen,nomb_empre, cargoP from propuesta 
	join usuarios_empre on cod_usuario=fk_userEmpre where fk_userEmpre=(select cod_usuario from usuarios_empre where
    nomb_usuario='$nombreUser')";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
