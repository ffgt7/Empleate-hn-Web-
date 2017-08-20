<?php
	include("../lib/conexion.php");
	
	$cod=$_POST["cod_empre"];
	$passActual=$_POST["pass"];
	$pass_empleo=$_POST['nuevaPass'];
	$confirmarPass=$_POST['confirmarPass'];
	
	$sql="select pass from usuarios_empre where cod_usuario=(select cod_usuario from usuarios_empre where nomb_usuario=?)";
	$resul=$conexion->prepare($sql);
	$resul->execute(array($cod));
	$rows=$resul->fetchAll();
	foreach($rows as $elementos):
	endforeach;
	
	$contraEncrip=password_hash($pass_empleo, PASSWORD_DEFAULT);
	if(password_verify($passActual,$elementos["pass"])){
		if(password_verify($confirmarPass,$contraEncrip)){
			$sqlC="select cod_usuario from usuarios_empre where nomb_usuario=?";
			$codU=$conexion->prepare($sqlC);
			$codU->execute(array($cod));
			$codFin=$codU->fetchAll();
			foreach($codFin as $codUp);
			$sql="update usuarios_empre set pass=? where cod_usuario=?";
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