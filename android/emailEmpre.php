<?php
     include("../lib/conexion.php");

    $email=$_POST['correoE'];
    
    $query = "select cod_usuario from usuarios_empre where email =?";
    $results = $conexion->prepare($query);
	$results->execute(array($email));
	$num=$results->rowCount();
	
	echo $num;
