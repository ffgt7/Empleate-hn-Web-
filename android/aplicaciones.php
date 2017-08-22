<?php
    include("../lib/conexion.php");
   
	$cod=$_POST['codHabi'];
	
	$sql='select * from aplicaciones where fk_habilidad=? order by nombAplica';
	$select=$conexion->prepare($sql);
    $select->execute(array($cod));
    $rows=$select->fetchAll();
	$json = array("items" => $rows);
    $items=json_encode($json);
    echo $items;