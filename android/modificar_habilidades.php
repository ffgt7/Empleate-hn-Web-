<?php
	include("../lib/conexion.php");
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
	
	$nom_user = $_GET['cod'];
	$cod_curri= $_GET['cod_curriHabi'];
	
	$sql=" select 	habilidad,nombAplica,nivel
	FROM currihabilidades
	JOIN habilidades on 	cod_habilidad=fk_habilidad
	JOIN aplicaciones on 	cod_aplicacion=fk_aplicacion
	JOIN nivelidiom on cod_nivel=fk_nivelHabi
	
	WHERE fk_userEmpleo=(SELECT cod_empleo FROM usuarios_empleo WHERE nomb_user ='$nom_user') and cod_curriHabi=$cod_curri";
	
	$rows=$res->llenarSelect($sql);
    $json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;