<?php
	include("../lib/conexion.php");
   
	$nombres=$_POST['nombres_r'];
	$apellidos=$_POST['apellidos_r'];
	$identidad=$_POST['identidad_r'];
	$direccion=$_POST['direccion_r'];
	$fijo=$_POST['fijo_r'];
	$movil=$_POST['movil_r'];
	$correo=$_POST['correo_r'];
	$alternativo=$_POST['alternativo_r'];
	$cod=$_POST['cod_referencai'];
		
		
	$userName= $_POST['userName'];
	$sql= "SELECT * from usuarios_empleo where nomb_user = :userName";
	$resultado= $conexion->prepare($sql);
	$resultado->execute(array(":userName"=>$userName));
	$n=$resultado->fetch(PDO::FETCH_ASSOC);
	$User= $n['cod_empleo'];

	$insert="update referencia set nombreR=?, apellidoR=?, identidadR=?,direccionR=?,telFR=?,telMR=?,correoR=?,	correolR2=? where fk_userRefe=? and cod_referencai=?";
	$result=$conexion->prepare($insert);
	$result->execute(array($nombres,$apellidos,$identidad,$direccion,$fijo,$movil,$correo,$alternativo,$User,$cod));