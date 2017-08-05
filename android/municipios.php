<?php
    include("../lib/conexion.php");
   
	$cod=$_POST['codDe'];
	
	$sql='select * from municipios where fk_depart=? order by muni';
	$select=$conexion->prepare($sql);
    $select->execute(array($cod));
    $rows=$select->fetchAll();
	$json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;