<?php
	include("../lib/conexion.php");
	
	$user=$_POST['user'];
    
    $query = "select cod_empleo from usuarios_empleo where nomb_user =?";
    $results = $conexion->prepare($query);
	$results->execute(array($user));
	$num=$results->rowCount();
	
	echo "$num";