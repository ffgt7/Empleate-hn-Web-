<?php
/*	 */
  
  require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
    $cod=$_GET["cod"];
    $sql5="select descrip_userEmpleo,nomb_user,apellidos,cod_empleo,email_user,direccion,Fech_regisUser,Fech_Naci,nombres,img_perfil,identidadC,sexo,tel_fijo,tel_movil,depart,nacionalidad,muni
	from usuarios_empleo join departamentos on cod_depart=fk_departamento join nacionalidades on cod_nacion=fk_nacionalida join municipios on cod_muni=fk_municipio
	where nomb_user='$cod'";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>
