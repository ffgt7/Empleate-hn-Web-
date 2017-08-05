<?php
  require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
    $cod=$_GET["cod"];
  $sql5="select habilidad, nombAplica, nivel from curriHabilidades join habilidades on cod_habilidad=fk_habilidad join aplicaciones on cod_aplicacion=fk_aplicacion
	join nivelidiom on cod_nivel=fk_nivelHabi where fk_userEmpleo=(select cod_empleo from usuarios_empleo where
   nomb_user='$cod')";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>
