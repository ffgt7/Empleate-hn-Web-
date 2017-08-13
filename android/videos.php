<?php
	require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
	$sql5="select codVideo,FKcategoria,link,descripcion,titulo,fecha,FKusuario,categoria,userAdmin from videos join 
catevideos on codCateVideo=FKcategoria join admin on codAdmin=FKusuario order by fecha DESC";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;

?>