<?php
	include("../lib/conexion.php");
	require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
	
	$nom_user = $_GET['cod'];
	$cod_curri= $_GET['cod_curri'];
	
	$sql=" select Nomb_Empre,pais,rubro,nomb_EscriPuesto,catego,puesto,descrip_Funcio,fech_IniTra,fech_FinTra  FROM curri_expelabo
	JOIN paises on cod_pais=fk_pais JOIN rubros on cod_rubro=fk_actividad JOIN categorias on cod_catego=fk_categ JOIN puestos on cod_Puesto=fk_puesto
	WHERE fk_userExpeLbo=(SELECT cod_empleo FROM usuarios_empleo WHERE nomb_user ='$nom_user') and cod_curri=$cod_curri";
	
	$rows=$res->llenarSelect($sql);
    $json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;