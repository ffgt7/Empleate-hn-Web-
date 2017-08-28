<?php
   include("../lib/conexion.php");
	
	$empresa=$_POST['empresa'];
	$pais=$_POST['pais'];
	$actividad=$_POST['actividad'];
	$cargo=$_POST['cargo'];
	$categoria=$_POST['categoria'];
	$puesto=$_POST['puesto'];
	$descripcion=$_POST['descripcion'];
	$inicio=$_POST['inicio'];
	$fin=$_POST['fin'];
	$codCurri=$_POST['cod_curri'];
		
	$userName= $_POST['userName'];
	$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
	$resultado= $conexion->prepare($sql);
	$resultado->execute(array(":userName"=>$userName));
	$n=$resultado->fetch(PDO::FETCH_ASSOC);
	$User= $n['cod_empleo'];

	$insert="UPDATE curri_expelabo set Nomb_Empre=?,fk_pais=?,fk_actividad=?,nomb_EscriPuesto=?,fk_categ=?,	fk_puesto=?,descrip_Funcio=?,fech_IniTra=?,fech_FinTra=? 
			where fk_userExpeLbo=? and cod_curri=?";
	$result=$conexion->prepare($insert);
	$result->execute(array($empresa,$pais,$actividad,$cargo,$categoria,$puesto,$descripcion,$inicio,$fin,$User,$codCurri));