<?php
    include("../lib/config.php");
	/*if(!isset($_POST['userName']))
	{
		require("../lib/permisosG.php");
		return;
	}*/
	$nombCurso=$_POST['NombreCurso'];
	$nombEmpre=$_POST['NombreEmpresa'];
	$pais=$_POST['pais'];
	$fechIni=$_POST['Fech_Ini'];
	$fechFin=$_POST['Fech_Fin'];

		include("../lib/conexion.php");
		
		$userName= $_POST['userName'];
		$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
		$resultado= $conexion->prepare($sql);
		$resultado->execute(array(":userName"=>$userName));
		$n=$resultado->fetch(PDO::FETCH_ASSOC);
		$User= $n['cod_empleo'];

		$insert="insert into curri_cursos(Nomb_curso, Nomb_Empre, fk_pais,fech_IniTra,fech_FinTra,fk_userCursos) values(?,?,?,?,?,?)";
		$result=$conexion->prepare($insert);
		$result->execute(array($nombCurso,$nombEmpre,$pais,$fechIni,$fechFin,$User));
