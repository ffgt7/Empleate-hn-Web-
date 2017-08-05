<?php
 		require "../lib/conexion.php";
        require('../lib/Llenado_Select.php');
    	$res=new Llenado_Select();
    	$nomb_usuario="frederik";

	    $sql="select nomb_usuario,descripcion FROM usuarios_empre WHERE nomb_usuario=?";
        
		$resultado= $conexion->prepare($sql);

		$resultado->execute(array($nomb_usuario));

		$n=$resultado->fetch(PDO::FETCH_ASSOC);
		    
 	    $json = array("items" => $n);
			
 		echo json_encode($json);