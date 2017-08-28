<?php
	include("../lib/conexion.php");
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
	
	$nom_user = $_GET['cod'];
	$cod_curri= $_GET['cod_referencai'];
	
	$sql=" select nombreR,apellidoR,identidadR,direccionR,telFR,telMR,correoR,correolR2
	FROM referencia
	WHERE 	fk_userRefe=(SELECT cod_empleo FROM usuarios_empleo WHERE nomb_user ='$nom_user') and cod_referencai=$cod_curri";
	
	$rows=$res->llenarSelect($sql);
    $json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;