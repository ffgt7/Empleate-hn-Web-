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
	;
	
	
		include("../lib/conexion.php");
		
		$userName= $_POST['userName'];
		$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
		$resultado= $conexion->prepare($sql);
		$resultado->execute(array(":userName"=>$userName));
		$n=$resultado->fetch(PDO::FETCH_ASSOC);
		$User= $n['cod_empleo'];

		$insert="insert into currihabilidades(fk_habilidad,fk_aplicacion,fk_nivelHabi,fk_userEmpleo)
		values(?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($habilidades,$aplicacion,$nivel,$User));