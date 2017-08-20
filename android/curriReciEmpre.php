<?php
	include("../lib/conexion.php");
	
	$codPro=$_GET['cod']; 
	
	$sql1="select DISTINCT requi_nocumple,cod_envio,cod_empleo,nombres,img_perfil,concat_ws(',', tituloObtenidoS, tituloObtenidoSecu) as titulo, 
	YEAR(CURDATE())-YEAR(Fech_Naci) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Fech_Naci,'%m-%d'), 0, -1) AS `EDAD_ACTUAL` from usuarios_empleo 
	left join educacion on cod_empleo=fk_userEdu left join curri_expelabo on fk_userExpeLbo=cod_empleo 
	left join curri_idioma on fk_userIdioma=cod_empleo left join enviocurri on fk_userDesem=cod_empleo
	where fk_propuesta=? order by cod_envio desc";
	$array_propuestas= $conexion->prepare($sql1);
	$array_propuestas->execute(array($codPro));
	$rows=$array_propuestas->fetchAll();
	$json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;