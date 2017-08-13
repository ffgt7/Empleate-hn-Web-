<?php
	require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
	$sql5="select codBlog,blog,fecha,categoria,cate,FKcreador,userAdmin from blog join cateblog on codCate=categoria 
	join admin on codAdmin=FKcreador order by fecha";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;

?>