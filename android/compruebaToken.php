<?php
    //$conexion= new PDO('mysql:host=localhost; dbname=empleo','root','');
                
    require("../lib/conexion.php");
                
    $token = $_POST['token'];
                
	$sql = " SELECT cod_usuario FROM recu_empre WHERE token = ? ";
	$resultado = $conexion->prepare($sql);
	$resultado->execute(array($token));
	
	$num=$resultado->rowCount();
	
    echo $num;
