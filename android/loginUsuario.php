<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	try{
		$nomb_usuario=htmlentities(addslashes($_POST["userName"]));
		$pass=htmlentities(addslashes($_POST["password"]));

		include("../lib/conexion.php");
		header('Content-Type: application/json');

		$sql="SELECT * FROM usuarios_empleo WHERE nomb_user= :nomb_usuario";

		$resultado= $conexion->prepare($sql);

		$resultado->execute(array(":nomb_usuario"=>$nomb_usuario));

		$n=$resultado->fetch(PDO::FETCH_ASSOC);
			
		if(password_verify($pass,$n['pass_empleo'])){
		    
 		   /* $json = array("items" => $n);
			
 			echo json_encode($json);*/

            echo "success";
			
		}else{
		    
		  //  print json_encode(
		  //      array(
		  //          'estado' => '2',
		  //          'mensaje' => 'Credenciales incorrectas, intente nuevamente, Gracias.',
		  //          'nombre' => $nomb_usuario
		  //      )    
		  //  );

            echo "error";
            
		}

	}catch(Exception $e){
		die("Error: " . $e->getMessage());
	}
	
}