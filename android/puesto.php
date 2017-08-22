<?php
    include("../lib/conexion.php");
   
	$cod=$_POST['cod_pues'];
	
	$sql='select * from puestos where fk_Catego=? order by puesto';
	$select=$conexion->prepare($sql);
    $select->execute(array($cod));
    $rows=$select->fetchAll();
	$json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;