<?php
	require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
	$sql5="SELECT cod_usuario,descripcion,email,imagen,nomb_empre,nomb_usuario,num_tel,pass,Pregunt_Seguri,web_site,respuesta,rubro,
	Preg_Segur FROM usuarios_empre JOIN rubros on cod_rubro=fk_rubro JOIN preg_segur on cod_preg=Pregunt_Seguri";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>