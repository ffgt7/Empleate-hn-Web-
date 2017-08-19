<?php
	include("../lib/conexion.php");
	
	$cod=$_POST["cod_usuario"];
	$passActual=$_POST["pass"];
	$pass_empleo=$_POST['nuevaPass'];
	$confirmarPass=$_POST['confirmarPass'];
	
	$sql="select pass_empleo from usuarios_empleo where cod_empleo=(select cod_empleo from usuarios_empleo where nomb_user=?)";
	$resul=$conexion->prepare($sql);
	$resul->execute(array($cod));
	$rows=$resul->fetchAll();
	foreach($rows as $elementos):
	endforeach;
	
	$contraEncrip=password_hash($pass_empleo, PASSWORD_DEFAULT);
	if(password_verify($passActual,$elementos["pass_empleo"])){
		if(password_verify($confirmarPass,$contraEncrip)){
			$sqlC="select cod_empleo from usuarios_empleo where nomb_user=?";
			$codU=$conexion->prepare($sqlC);
			$codU->execute(array($cod));
			$codFin=$codU->fetchAll();
			foreach($codFin as $codUp);
			$sql="update usuarios_empleo set pass_empleo=? where cod_empleo=?";
			$resultado=$conexion->prepare($sql);
			$resultado->execute(array($contraEncrip,$codUp['0']));
			$r=1;
			echo $r;
     
		}else {
			$r=2;
			echo $r;
		}
	}else {
	$r=0;
    echo $r;
  }