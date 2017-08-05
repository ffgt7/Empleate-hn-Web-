<?php
  require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
    $cod=$_GET["cod"];
  $sql5="SELECT cod_curso, Nomb_curso, Nomb_Empre, fech_IniTra,fech_FinTra, pais FROM curri_cursos JOIN
	paises ON cod_pais = fk_pais where fk_userCursos=(select cod_empleo from usuarios_empleo where
   nomb_user='$cod')";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>
