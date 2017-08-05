<?php
	include("../lib/conexion.php");

    $email=$_POST['correo'];
    
    $query = "select cod_empleo from usuarios_empleo where email_user =?";
    $results = $conexion->prepare($query);
	$results->execute(array($email));
	$num=$results->rowCount();
	
	echo "$num";