<?php
    include("../lib/config.php");
	if(!isset($_POST['userName']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$habilidades=$_POST['habilidades'];
	$aplicacion=$_POST['aplicacion'];
	$nivel=$_POST['nivel'];
	$cod=$_POST['cod_curriHabi'];
	
	
		include("../lib/conexion.php");
		
		$userName= $_POST['userName'];
		$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
		$resultado= $conexion->prepare($sql);
		$resultado->execute(array(":userName"=>$userName));
		$n=$resultado->fetch(PDO::FETCH_ASSOC);
		$User= $n['cod_empleo'];

		$insert="UPDATE currihabilidades set fk_habilidad=?,fk_aplicacion=?,fk_nivelHabi=?,fk_userEmpleo=? where 	fk_userEmpleo=? and cod_curriHabi=?";
		$result=$conexion->prepare($insert);
		$result->execute(array($habilidades,$aplicacion,$nivel,$User,$cod));