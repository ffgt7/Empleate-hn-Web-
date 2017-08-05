<?php
    require "../lib/conexion.php";
    require('../lib/Llenado_Select.php');
	$res=new Llenado_Select();
	
	$sql='select * from rubros order by rubro';
		$rows=$res->llenarSelect($sql);
		$json = array("acti" => $rows);
        $acti=json_encode($json);
        echo $acti;
?>