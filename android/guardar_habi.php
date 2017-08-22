<?php
    include("../lib/config.php");
	if(!isset($_POST['userName']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$primaria=$_POST['primaria'];
	$primaria_i=$_POST['primaria_inicio'];
	$primaria_f=$_POST['primaria_fin'];
	$secundaria=$_POST['secundaria'];
	$secundaria_i=$_POST['secundaria_inicio'];
	$secundaria_f=$_POST['secundaria_fin'];
	$secundaria_t=$_POST['secundaria_titulo'];
	$carrera=$_POST['carrera'];
	$superior=$_POST['superior'];
	$superior_i=$_POST['superior_inicio'];
	$superior_f=$_POST['superior_fin'];
	$superior_t=$_POST['superior_titulo'];
	

		include("../lib/conexion.php");
		
		$userName= $_POST['userName'];
		$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
		$resultado= $conexion->prepare($sql);
		$resultado->execute(array(":userName"=>$userName));
		$n=$resultado->fetch(PDO::FETCH_ASSOC);
		$User= $n['cod_empleo'];

		$insert="insert into educacion(primaria, primariI, primariaF,secundaria,secundariaI,secundariaF,superior,superiorI,superiorF,tituloObtenidoS,carrera,tituloObtenidoSecu,fk_userEdu)
		values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($primaria,$primaria_i,$primaria_f,$secundaria,$secundaria_i,$secundaria_f,$superior,$superior_i,$superior_f,$superior_t,$carrera,$secundaria_t,$User));