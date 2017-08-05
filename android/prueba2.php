<?php
    require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
//	$cod=$_GET["cod"];
	$sql="SELECT nomb_usuario FROM usuarios_empre WHERE nomb_usuario=frederik";
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>
?>