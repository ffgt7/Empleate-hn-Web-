<?php
    require "../lib/conexion.php";
    require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
	
	$sql='select * from preg_segur';
		$rows=$res->llenarSelect($sql);
		$json = array("items" => $rows);
        $items=json_encode($json);
        echo $items;
?>