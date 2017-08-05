<?php
 include("../lib/conexion.php");
 
 $sql="select * from licencias";
 $select=$conexion->prepare($sql);
 $select->execute();
 $rows=$select->fetchAll();
 $json= array("items"=>$rows);
 $items=json_encode($json);
 echo $items;
 