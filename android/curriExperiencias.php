<?php
  require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
    $cod=$_GET["cod"];
  $sql5="SELECT cod_curri, Nomb_Empre, fech_FinTra, fech_IniTra, Nomb_EscriPuesto, descrip_Funcio,fk_actividad,fk_categ,fk_puesto,
	puesto, pais, rubro, catego FROM curri_expelabo JOIN puestos ON cod_Puesto = fk_puesto JOIN paises ON
	cod_pais = fk_pais JOIN rubros ON cod_rubro = fk_actividad JOIN categorias ON cod_catego = fk_categ where fk_userExpeLbo=(select cod_empleo from usuarios_empleo where
   nomb_user='$cod')";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>
