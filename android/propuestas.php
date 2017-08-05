<?php
/*	 */
  
  require "../lib/conexion.php";
	include "../lib/Llenado_Select.php";
	$w=new Llenado_Select();
	$cod=$_GET["cod"];
	$sql5="select cod_propuesta,nombreP,tipoP,generoP,edad,salarioP,vehiculoP,licenciaP,departamentoP,
  caducidadP,tituloP,descripcionP,vacantesP,fk_areaP,cargoP,edad2,salario2,descripcion2,descripcion3,fk_departamento,
  fk_municipio,catego,depart,muni,imagen,experien,idioma,nivel from propuesta join categorias on cod_catego=fk_areaP join departamentos on
  cod_depart=fk_departamento join municipios on cod_muni=fk_municipio join usuarios_empre on cod_usuario=fk_userEmpre join experiencia on cod_experi=fk_experienciaP join 
  idioma on cod_idioma=fk_idioma join nivelidiom on cod_nivel=fk_nivelIdiom where cod_propuesta=$cod";
	$array=$w->llenarSelect($sql5);
	$json = array("items" => $array);
    $items=json_encode($json);
    echo $items;
?>

  