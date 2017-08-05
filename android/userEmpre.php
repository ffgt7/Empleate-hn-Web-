<?php
    include("../lib/conexion.php");
    
    $user=$_POST['userEmpre'];
    
    $query = "select cod_usuario from usuarios_empre where nomb_usuario =?";
    $results = $conexion->prepare($query);
	$results->execute(array($user));
	$num=$results->rowCount();
	
	echo "$num";