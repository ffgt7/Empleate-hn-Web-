<?php

require("../lib/conexion.php");

if(isset($_SESSION["cod_usuarioE"])){

	$codUser = htmlentities(addslashes($_SESSION["cod_usuarioE"]));
	
	
	$ip = htmlentities(addslashes($_SERVER['REMOTE_ADDR']));

    $consulta="select ip, TIMEDIFF(NOW(),fecha),fecha, num_visitas, cod_visitante, cod_perfil from contadorempre where cod_visitante= :codUser";
    
    $resultado= $conexion->prepare($consulta);
    
    $resultado->bindValue(":codUser", $codUser);
    
    $resultado->execute(array(':codUser'=>$codUser));
    
    $fila=$resultado->fetch(PDO::FETCH_ASSOC);
    
    $tiempo=$fila['(TIMEDIFF(NOW(),fecha)'];
    
    $num_visitas=$fila['num_visitas'];
    
    $horas_t=substr($tiempo,0,2);
    
    $tiemRes = 5;


	$sql="select * from usuarios_empre where cod_usuario= :codUser";

	$resul= $conexion->prepare($sql);

	$resul->bindValue(":codUser",$codUser);

	$resul->execute(array(':codUser'=>$codUser));

	$elemento=$resul->fetch(PDO::FETCH_ASSOC);

	if ($resultado->rowCount() == 0 && $resul->rowCount() == 1 ){

		$cod_perfil = htmlentities(addslashes($_GET["cod"]));

		$sql1="insert into contadorempre(ip, num_visitas, fecha, cod_visitante, cod_perfil) values('$ip', 1, NOW(), '$codUser', '$cod_perfil')";
		$resultado1= $conexion->prepare($sql1);
		$resultado1->execute(array());

	}
	elseif($resultado->rowCount() == 1 && $resul->rowCount() == 1 && $horas_t > $tiemRes){

		$sql2="update contadorempre set fecha=NOW(), num_visitas= '$num_visitas'+1 where cod_visitante= $codUser";
		$resultado2= $conexion->prepare($sql2);
		$resultado2->execute(array());

	}

}elseif(isset($_SESSION["cod_usuario"])){

	$codUser = htmlentities(addslashes($_SESSION["cod_usuario"]));
	
	
	$ip = htmlentities(addslashes($_SERVER['REMOTE_ADDR']));

    $consulta="select ip, TIMEDIFF(NOW(),fecha),fecha, num_visitas, cod_visitante, cod_perfil from contadorempre where cod_visitante= :codUser";
    
    $resultado= $conexion->prepare($consulta);
    
    $resultado->bindValue(":codUser", $codUser);
    
    $resultado->execute(array(':codUser'=>$codUser));
    
    $fila=$resultado->fetch(PDO::FETCH_ASSOC);
    
    $tiempo=$fila['(TIMEDIFF(NOW(),fecha)'];
    
    $num_visitas=$fila['num_visitas'];
    
    $horas_t=substr($tiempo,0,2);
    
    $tiemRes = 5;
	

	$sql3="select * from usuarios_empleo where cod_empleo= :codUser";

	$resul2= $conexion->prepare($sql3);

	$resul2->bindValue(":codUser",$codUser);

	$resul2->execute(array(':codUser'=>$codUser));

	$elemento=$resul2->fetch(PDO::FETCH_ASSOC);

	if ($resultado->rowCount() == 0 && $resul2->rowCount() == 1){

		$cod_perfil = htmlentities(addslashes($_GET["cod"]));

		$sql1="insert into contadorempre(ip, num_visitas, fecha, cod_visitante, cod_perfil) values('$ip', 1, NOW(), '$codUser', '$cod_perfil')";
		$resultado1= $conexion->prepare($sql1);
		$resultado1->execute(array());

	}elseif($resultado->rowCount() == 1 && $resul2->rowCount() == 1 && $horas_t > $tiemRes){

		$sql3="update contadorempre set fecha=NOW(), num_visitas= '$num_visitas'+1 where cod_visitante= $codUser";
		$resultado2= $conexion->prepare($sql3);
		$resultado2->execute(array());

	}
	
}elseif(!isset($_SESSION["cod_usuario"]) && !isset($_SESSION["cod_usuarioE"])){
    
    $ip = htmlentities(addslashes($_SERVER['REMOTE_ADDR']));
    $cod_perfil = htmlentities(addslashes($_GET["cod"]));
	    
    $sql4= "insert into contadorempre(ip, num_visitas, fecha, cod_visitante, cod_perfil) values('$ip', 1, NOW(), 65, '$cod_perfil')";
    $resultado3= $conexion->prepare($sql4);
	$resultado3->execute(array());
}

?>
