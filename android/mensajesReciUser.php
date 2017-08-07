<?php
  require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
    $cod=$_GET["cod"];
  $sql5="select CodMensajee,asunto,texto,de,fk_Usuario,imagen,fecha,nomb_empre,nomb_usuario,cod_usuario from usuarios_empre join  mensajese on 
	cod_usuario=de join usuarios_empleo on cod_empleo=fk_Usuario where fk_Usuario=(select cod_empleo from usuarios_empleo where
   nomb_user='$cod')";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>
