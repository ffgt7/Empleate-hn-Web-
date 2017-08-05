<?php
	require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
	$sql5="select cod_propuesta as codigo, nombreP as titulo,descripcionP as descripcion,caducidadP as fecha,imagen as imagen,nomb_empre from propuesta 
	join usuarios_empre on cod_usuario=fk_userEmpre where propuesta.estado = 1 order by caducidadP asc";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>