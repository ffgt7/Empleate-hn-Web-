<?php
    include("../lib/config.php");
	if(!isset($_POST['userName']))
	{
		require("../lib/permisosG.php");
		return;
	}
	$primaria=$_POST['primaria'];
	$primariaI=$_POST['primaria_inicio'];
	$primariaF=$_POST['primaria_fin'];
	$secundaria=$_POST['secundaria'];
	$secundariaI=$_POST['secundaria_inicio'];
	$secundariaF=$_POST['secundaria_fin'];
	$superior=$_POST['superior'];
	$superiorI=$_POST['superior_inicio'];
	$superiorF=$_POST['superior_fin'];
	$tituloSuperior=$_POST['secundaria_titulo'];
	$carrera=$_POST['carrera'];
	$tituloMedia=$_POST['superior_titulo'];
	

		include("../lib/conexion.php");
		
		$userName= $_POST['userName'];
		$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
		$resultado= $conexion->prepare($sql);
		$resultado->execute(array(":userName"=>$userName));
		$n=$resultado->fetch(PDO::FETCH_ASSOC);
		$User= $n['cod_empleo'];

        $insert="insert into educacion(primaria,primariI,primariaF,secundaria,secundariaI,secundariaF,superior,superiorI,
                 superiorF,tituloObtenidoS,carrera,tituloObtenidoSecu,fk_userEdu)values(?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $result=$conexion->prepare($insert);
        $result->execute(array($primaria,$primariaI,$primariaF,$secundaria,$secundariaI,$secundariaF,$superior,$superiorI,
                        $superiorF,$tituloSuperior,$carrera,$tituloMedia,$User));