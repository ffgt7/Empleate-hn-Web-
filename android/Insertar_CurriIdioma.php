<?php
    include("../lib/config.php");
	if(!isset($_POST['userName']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$nombIdioma=$_POST['NombreIdioma'];
	$nivelIdioma=$_POST['NivelIdioma'];

		include("../lib/conexion.php");
		
		$userName= $_POST['userName'];
		$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
		$resultado= $conexion->prepare($sql);
		$resultado->execute(array(":userName"=>$userName));
		$n=$resultado->fetch(PDO::FETCH_ASSOC);
		$User= $n['cod_empleo'];
		
		$insert="insert into curri_idioma(fk_userIdioma, fk_idioma, fk_nivel) values(?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($User,$nombIdioma,$nivelIdioma));
